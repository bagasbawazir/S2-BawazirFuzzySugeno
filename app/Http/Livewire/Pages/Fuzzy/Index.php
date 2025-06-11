<?php

namespace App\Http\Livewire\Pages\Fuzzy;

use App\Models\InggridientHistory;
use Livewire\Component;
use App\Models\Purchase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class Index extends Component
{
    public $date_start;
    public $date_end;

    public $keySubmit;
    public $load_datatable = false;

    public $inggridient = [];
    public $range = [];




    public function mount(): void
    {
    }

    public function render()
    {
        $this->dispatchBrowserEvent('destroy');
        $this->dispatchBrowserEvent('initSomething');


        return view('livewire.pages.fuzzy.index')->extends('layouts.app')->section('wrapper');
    }


    public function submit()
    {
        $this->validate([
            'date_start' => 'required',
            'date_end' => 'required',
        ]);

        // Fuzzyfikasi
        $start = Carbon::createFromFormat('d/m/Y', $this->date_start)->format('Y-m-d');
        $end = Carbon::createFromFormat('d/m/Y', $this->date_end);

        $date_start = InggridientHistory::select('date')->where('date', $start)->orderBy('date')->first();
        $date_end = InggridientHistory::orderBy('date', 'DESC')
            ->where('date', Carbon::create($end->format('Y'), $end->format('m'), '01'))
            ->orderBy('id_inggridient', 'ASC')
            ->get()
            ->unique('id_inggridient');

        // $end = Carbon::create($date_end->date)->subMonth(11)->format('Y-m-d');

        $this->inggridient = InggridientHistory::select('date', 'id_history', 'id_inggridient')
            ->whereBetween('date', [$start, $end])
            ->groupBy('id_inggridient')
            ->get();

        $min_stock_in = InggridientHistory::select('date', 'id_history', 'id_inggridient', DB::raw('min(stock_in) AS sedikit'))
            ->whereBetween('date', [$start, $end])
            ->groupBy('id_inggridient')
            ->get();

        $max_stock_in = InggridientHistory::select('date', 'id_history', 'id_inggridient', DB::raw('max(stock_in) AS banyak'))
            ->whereBetween('date', [$start, $end])
            ->groupBy('id_inggridient')
            ->get();

        $min_stock_out = InggridientHistory::select('date', 'id_history', 'id_inggridient', DB::raw('min(stock_out) AS kurang'))
            ->whereBetween('date', [$start, $end])
            ->groupBy('id_inggridient')
            ->get();

        $max_stock_out = InggridientHistory::select('date', 'id_history', 'id_inggridient', DB::raw('max(stock_out) AS tambah'))
            ->whereBetween('date', [$start, $end])
            ->groupBy('id_inggridient')
            ->get();

        $min_last_stock = InggridientHistory::select('date', 'id_history', 'id_inggridient', DB::raw('min(last_stock) AS kecil'))
            ->whereBetween('date', [$start, $end])
            ->groupBy('id_inggridient')
            ->get();

        $max_last_stock = InggridientHistory::select('date', 'id_history', 'id_inggridient', DB::raw('max(last_stock) AS besar'))
            ->whereBetween('date', [$start, $end])
            ->groupBy('id_inggridient')
            ->get();


        $x = 0;

        foreach ($this->inggridient as $key => $value) {

            // input
            $stock_in = $date_end[$key]->stock_in;
            $stock_out =  $date_end[$key]->stock_out;
            $last_stock = $date_end[$key]->last_stock;

            // deklar
            $max_in = $max_stock_in[$key]->banyak;
            $min_in = $min_stock_in[$key]->sedikit;

            $max_out = $max_stock_out[$key]->tambah;
            $min_out = $min_stock_out[$key]->kurang;

            $max_last = $max_last_stock[$key]->besar;
            $min_last = $min_last_stock[$key]->kecil;


            //stock in max calculate============================================================
            $this->range[$key]['range_in'] = $max_stock_in[$key]->banyak - $min_stock_in[$key]->sedikit;
            $this->range[$key]['max_in'] = $max_in  - $stock_in;
            $this->range[$key]['little'] = $this->range[$key]['max_in'] / $this->range[$key]['range_in'];

            //stock in min calculate
            $this->range[$key]['min_in'] = $stock_in - $min_in;
            $this->range[$key]['lots'] = $this->range[$key]['min_in'] / $this->range[$key]['range_in'];

            //stock out max calculate============================================================
            $this->range[$key]['range_out'] =  $max_stock_out[$key]->tambah - $min_stock_out[$key]->kurang;
            $this->range[$key]['max_out'] = $max_out - $stock_out;
            $this->range[$key]['not_enough'] = $this->range[$key]['max_out'] / $this->range[$key]['range_out'];

            //stock out min calculate
            $this->range[$key]['min_out'] = $stock_out - $min_out;
            $this->range[$key]['plus'] = $this->range[$key]['min_out'] / $this->range[$key]['range_out'];

            //last stock max calculate =============================================================
            $this->range[$key]['range_last'] = $max_last_stock[$key]->besar - $min_last_stock[$key]->kecil;
            $this->range[$key]['max_last'] = $max_last - $last_stock;
            $this->range[$key]['small'] = $this->range[$key]['max_last'] / $this->range[$key]['range_last'];

            $this->range[$key]['min_last'] = $last_stock - $min_last;
            $this->range[$key]['big'] = $this->range[$key]['min_last'] / $this->range[$key]['range_last'];

            // Nilai keanggotaan R1
            $this->range[$key]['R1'] = min($this->range[$key]['lots'], $this->range[$key]['plus'], $this->range[$key]['small']);

            // Nilai keanggotaan R2
            $this->range[$key]['R2'] = min($this->range[$key]['lots'], $this->range[$key]['not_enough'], $this->range[$key]['big']);

            // Nilai keanggotaan R3
            $this->range[$key]['R3'] = min($this->range[$key]['little'], $this->range[$key]['not_enough'], $this->range[$key]['small']);



            if ($max_in >= $stock_in  && $max_out >= $stock_out && $min_last <= $last_stock) {
                $this->range[$key]['resultR1'] = $stock_out - $last_stock;
            }

            if ($max_in >= $stock_in  && $min_out <= $stock_out  &&  $max_last >= $last_stock) {
                $this->range[$key]['resultR2'] = $stock_in - $last_stock;
            }
            if ($min_in <= $stock_in  && $min_out <= $stock_out && $min_last <= $last_stock) {
                $this->range[$key]['resultR3'] = $last_stock;
            }
            $this->range[$key]['countR1'] = $this->range[$key]['R1'] * $this->range[$key]['resultR1'];

            $this->range[$key]['countR2'] = $this->range[$key]['R2'] * $this->range[$key]['resultR2'];

            $this->range[$key]['countR3'] = $this->range[$key]['R3'] * $this->range[$key]['resultR3'];


            $this->range[$key]['nilai_atas'] = $this->range[$key]['countR1'] + $this->range[$key]['countR2'] + $this->range[$key]['countR3'];

            $this->range[$key]['nilai_keanggotaan'] = $this->range[$key]['R1'] + $this->range[$key]['R2'] + $this->range[$key]['R3'];

            $this->range[$key]['defuzzy'] = $this->range[$key]['nilai_atas'] / $this->range[$key]['nilai_keanggotaan'];
        }







        $this->keySubmit = 1;
        $this->load_datatable = true;

        $this->dispatchBrowserEvent('destroy');
        $this->dispatchBrowserEvent('initSomething');

        DB::table('inggridient_history')->delete();
        DB::statement("ALTER TABLE inggridient_history AUTO_INCREMENT = 1;");

        Artisan::call('db:seed --class=InggridientHistorySeeder');
    }
}

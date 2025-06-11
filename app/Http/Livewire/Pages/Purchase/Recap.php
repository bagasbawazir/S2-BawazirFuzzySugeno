<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pages\Purchase;

use App\Models\Purchase;
use App\Models\MasterInggridient;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use Livewire\Component;

class Recap extends Component
{
    public $purchase;


    public $date_start;
    public $date_end;

    public $data_first_date;
    public $data_last_date;

    public $keySubmit;
    public $recapPurchase = false;
    public $load_datatable = false;

    public $recap = [];

    public function render()
    {
        $this->dispatchBrowserEvent('destroy');
        $this->dispatchBrowserEvent('initSomething');

        return view('livewire.pages.purchase.recap')->extends('layouts.app')->section('wrapper');
    }

    public function mount()
    {
        $purchase_first = Purchase::select('id_purchase', 'date_purchase')->orderBy('date_purchase', 'ASC')->first();
        $purchase_last = Purchase::select('id_purchase', 'date_purchase')->orderBy('date_purchase', 'DESC')->first();

        $first = Carbon::create($purchase_first->date_purchase);

        $this->data_first_date = Carbon::create($first->format('Y'), $first->format('n'), '01')->format('m/d/Y');
        $this->data_last_date = Carbon::create($purchase_last->date_purchase)->format('m/d/Y');
    }

    public function submit()
    {
        $this->recap = null;

        $this->validate([
            'date_start' => 'required',
            'date_end' => 'required',

        ]);

        $date_start = Carbon::createFromFormat('d/m/Y', $this->date_start)->format('Y-m-d');
        $date_end = Carbon::createFromFormat('d/m/Y', $this->date_end)->format('Y-m-d');

        $recapPurchase = DB::table('purchases')
            ->select(DB::raw('master_inggridients.id_inggridient, master_inggridients.name_inggridient, SUM(detail_purchases.qty) as total_qty, master_inggridients.unit_inggridient, SUM(detail_purchases.total_price_inggridient) as total_price'))
            ->join('detail_purchases', 'purchases.id_purchase', '=', 'detail_purchases.id_purchase')
            ->join('master_inggridients', 'master_inggridients.id_inggridient', '=', 'detail_purchases.id_inggridient')
            ->groupByRaw('master_inggridients.id_inggridient')
            ->whereBetween('purchases.date_purchase', [$date_start, $date_end])
            ->get();


        foreach ($recapPurchase as $key => $value) {
            $this->recap[] = [
                'id_inggridient' => $value->id_inggridient,
                'name_inggridient' => $value->name_inggridient,
                'qty' => $value->total_qty,
                'unit_inggridient' => $value->unit_inggridient,
                'total_price_inggridient' => $value->total_price
            ];
        }

        $this->keySubmit = 1;
        $this->load_datatable = true;
        $this->recapPurchase = true;
    }
}

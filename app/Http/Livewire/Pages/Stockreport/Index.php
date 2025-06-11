<?php

namespace App\Http\Livewire\Pages\StockReport;

use Livewire\Component;
use App\Models\Purchase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class Index extends Component
{
    public $date_start;
    public $date_end;

    public $data_first_date;
    public $data_last_date;

    public $keySubmit;
    public $load_datatable = false;

    public function mount(): void
    {
        $purchase_first = Purchase::select('id_purchase', 'date_purchase')->orderBy('date_purchase', 'ASC')->first();
        $purchase_last = Purchase::select('id_purchase', 'date_purchase')->orderBy('date_purchase', 'DESC')->first();

        $first = Carbon::create($purchase_first->date_purchase);

        $this->data_first_date = Carbon::create($first->format('Y'), $first->format('n'), '01')->format('m/d/Y');
        $this->data_last_date = Carbon::create($purchase_last->date_purchase)->format('m/d/Y');
    }

    public function render()
    {
        $this->dispatchBrowserEvent('destroy');
        $this->dispatchBrowserEvent('initSomething');

        return view('livewire.pages.stockreport.index')->extends('layouts.app')->section('wrapper');
    }

    public function submit()
    {
        $this->validate([
            'date_start' => 'required',
            'date_end' => 'required',
        ]);

        $this->dispatchBrowserEvent('destroy');
        $this->dispatchBrowserEvent('initSomething');

        $this->keySubmit = 1;
        $this->load_datatable = true;

        DB::table('inggridient_history')->delete();
        DB::statement("ALTER TABLE inggridient_history AUTO_INCREMENT = 1;");

        Artisan::call('db:seed --class=InggridientHistorySeeder');
    }
}

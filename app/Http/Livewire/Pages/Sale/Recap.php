<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pages\Sale;

use App\Models\RequestSale;
use App\Models\MasterProduct;
use App\Models\MasterInggridient;
use DateTime;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use Livewire\Component;

class Recap extends Component
{
    public $sale;

    public $date_start;
    public $date_end;

    public $data_first_date;
    public $data_last_date;

    public $keySubmit;
    public $recapSale = false;
    public $load_datatable = false;

    public $recap = [];

    public function render()
    {
        $this->dispatchBrowserEvent('destroy');
        $this->dispatchBrowserEvent('initSomething');

        return view('livewire.pages.sale.recap')->extends('layouts.app')->section('wrapper');
    }

    public function mount()
    {
        $sale_first = RequestSale::select('id_sale', 'date_sale')->orderBy('date_sale', 'ASC')->first();
        $sale_last = RequestSale::select('id_sale', 'date_sale')->orderBy('date_sale', 'DESC')->first();

        $first = Carbon::create($sale_first->date_sale);

        $this->data_first_date = Carbon::create($first->format('Y'), $first->format('n'), '01')->format('m/d/Y');
        $this->data_last_date = Carbon::create($sale_last->date_purchase)->format('m/d/Y');
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

        $recapSale = DB::table('request_sales')
            ->select(DB::raw('master_products.id_product, master_products.name_product, master_products.unit_product, SUM(detail_request_sales.qty) as total_qty, SUM(detail_request_sales.total_price_product) as total_price'))
            ->join('detail_request_sales', 'request_sales.id_sale', '=', 'detail_request_sales.id_sale')
            ->join('master_products', 'master_products.id_product', '=', 'detail_request_sales.id_product')
            ->groupByRaw('master_products.id_product')
            ->whereBetween('request_sales.date_sale', [$date_start, $date_end])
            ->get();

        foreach ($recapSale as $key => $value) {
            $this->recap[] = [
                'id_product' => $value->id_product,
                'name_product' => $value->name_product,
                'unit_product' => $value->unit_product,
                'qty' => $value->total_qty,
                'total_price_product' => $value->total_price
            ];
        }

        $this->keySubmit = 1;
        $this->load_datatable = true;
        $this->recapSale = true;
    }
}

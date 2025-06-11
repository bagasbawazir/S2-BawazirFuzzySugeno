<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pages\Sale;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\RequestSale;
use App\Models\MasterProduct;
use App\Models\MasterInggridient;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;

    public RequestSale $request_sale;

    public $qty_sale;
    public $date_sale;

    public $qty;
    public $keyProduct;
    public $total_price_product;
    public array $listsForProduct = [];

    public array $sale_product = [];

    // protected $listeners = ['add_product', 'delete_product'];

    public function mount(RequestSale $request_sale): void
    {
        $this->request_sale = $request_sale;
        $this->listsForProduct();
    }

    public function render()
    {
        return view('livewire.pages.sale.create')->extends('layouts.app')->section('wrapper');
    }

    public function submit(): void
    {
        $this->validate([
            'qty_sale' => 'required|numeric|min:1',
            'date_sale' => 'required',
        ]);

        $this->request_sale->id_user = auth()->user()->id_user;
        $this->request_sale->qty_sale = $this->qty_sale;
        $this->request_sale->date_sale = Carbon::createFromFormat('d/m/Y', $this->date_sale);

        $this->request_sale->save();

        $sync_data = [];

        foreach ($this->sale_product as $key => $value) {
            MasterInggridient::unsetEventDispatcher();

            $find_master_product = MasterProduct::with(['master_inggridients'])->find($value['id_product']);

            foreach ($find_master_product->master_inggridients as $key => $inggridient) {
                $find_master_inggridient = MasterInggridient::find($inggridient['id_inggridient'])->decrement('qty_inggridient', $value['qty'] * $inggridient['pivot']->usage_amount);
            }

            $sync_data[] = [
                'id_product' => $value['id_product'],
                'qty' => $value['qty'],
                'total_price_product' => $value['total_price_product'],
            ];
        }

        $this->request_sale->master_products()->sync($sync_data);
    }

    public function add_product(): void
    {
        $check_condition = true;

        $this->validate([
            'keyProduct' => 'required',
            'qty' => 'required|numeric|min:1',
        ]);

        $find_master_product = MasterProduct::with(['master_inggridients'])->find($this->keyProduct);

        foreach ($find_master_product->master_inggridients as $key => $value) {
            $stock = $value['qty_inggridient'];
            $usage_amount = $value['pivot']->usage_amount;
            $total_usage_amount = $this->qty * $usage_amount;

            if ($total_usage_amount >= $stock) {
                $check_condition = false;

                $this->alert('warning', 'Add Product to Cart Failed!.', [
                    'position' => 'center',
                    'timer' => '',
                    'toast' => false,
                    'text' => 'The Ingredients to make the product are insufficient',
                    'showConfirmButton' => true,
                    'onConfirmed' => '',
                    'confirmButtonText' => 'Ok',
                ]);
            }
        }

        if ($check_condition) {
            $data_product = [
                'id_product' => $find_master_product->id_product,
                'name_product' => $find_master_product->name_product,
                'unit_product' => $find_master_product->unit_product,
                'price_product' => $find_master_product->price_product,
                'total_price_product' => $find_master_product->price_product * $this->qty,
                'qty' => $this->qty,
            ];

            $this->sale_product[$data_product['id_product']] = $data_product;

            $this->qty_sale = count($this->sale_product);

            $this->qty = '';
        }
    }

    public function delete_product($value): void
    {
        unset($this->sale_product[$value]);

        $this->qty_sale = count($this->sale_product);
    }

    protected function listsForProduct(): void
    {
        $this->listsForProduct['master_products'] = MasterProduct::get();
    }
}

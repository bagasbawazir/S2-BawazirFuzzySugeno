<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pages\Purchase;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\MasterInggridient;

class Create extends Component
{
    public Purchase $purchase;

    public $keySupplier = '';
    public $date_purchase;
    public $qty_purchase_inggridient = 0;
    public array $listsForSupplier = [];

    public $qty;
    public $description_purchase;
    public $date_expired;
    public $keyInggridient = '';
    public array $listsForInggridient = [];

    public array $purchase_inggridient = [];

    protected $listeners = ['add_inggridient', 'delete_inggridient'];

    public function mount(Purchase $purchase): void
    {
        $this->purchase = $purchase;
        $this->listsForInggridient();
        $this->listsForSupplier();
    }

    public function render()
    {
        return view('livewire.pages.purchase.create')->extends('layouts.app')->section('wrapper');
    }

    public function submit(): void
    {
        $this->validate([
            'keySupplier' => 'required',
            'qty_purchase_inggridient' => 'required|numeric|min:1',
            'date_purchase' => 'required',
            'description_purchase' => 'required'

        ]);

        $this->purchase->id_supplier = $this->keySupplier;
        $this->purchase->id_user = auth()->user()->id_user;
        $this->purchase->qty_purchase_inggridient = $this->qty_purchase_inggridient;
        $this->purchase->date_purchase = Carbon::createFromFormat('d/m/Y', $this->date_purchase);
        $this->purchase->description_purchase = $this->description_purchase;
        $this->purchase->save();

        $sync_data = [];

        foreach ($this->purchase_inggridient as $key => $value) {
            MasterInggridient::unsetEventDispatcher();

            $find_master_inggridient = MasterInggridient::find($value['id_inggridient'])->increment('qty_inggridient', $value['qty']);

            $sync_data[] = [
                'id_inggridient' => $value['id_inggridient'],
                'date_expired' => Carbon::createFromFormat('d/m/Y', $value['date_expired']),
                'qty' => $value['qty'],
                'total_price_inggridient' => $value['total_price_inggridient'],
            ];
        }

        $this->purchase->master_inggridients()->sync($sync_data);
    }

    public function add_inggridient(): void
    {
        $this->validate([
            'keyInggridient' => 'required',
            'qty' => 'required|numeric|min:1000',
            'date_expired' => 'required',
        ]);

        $find_master_inggridient = MasterInggridient::find($this->keyInggridient);

        $data_inggridient = [
            'id_inggridient' => $find_master_inggridient->id_inggridient,
            'name_inggridient' => $find_master_inggridient->name_inggridient,
            'unit_inggridient' => $find_master_inggridient->unit_inggridient,
            'price_inggridient' => $find_master_inggridient->price_inggridient,
            'total_price_inggridient' => $find_master_inggridient->price_inggridient * $this->qty,
            'qty' => $this->qty,
            'date_expired' => $this->date_expired,
        ];

        $this->purchase_inggridient[$data_inggridient['id_inggridient']] = $data_inggridient;

        $this->qty_purchase_inggridient = count($this->purchase_inggridient);

        $this->qty = '';
        $this->date_expired = '';
    }

    public function delete_inggridient($value): void
    {
        unset($this->purchase_inggridient[$value]);

        $this->qty_purchase_inggridient = count($this->purchase_inggridient);
    }

    protected function listsForSupplier(): void
    {
        $this->listsForSupplier['suppliers'] = Supplier::get();
    }

    protected function listsForInggridient(): void
    {
        $this->listsForInggridient['inggridients'] = MasterInggridient::get();
    }
}

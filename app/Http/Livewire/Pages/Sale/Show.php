<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pages\Sale;

use Livewire\Component;
use App\Models\RequestSale;

class Show extends Component
{
    public RequestSale $request_sale;

    public function mount(RequestSale $request_sale): void
    {
        $this->request_sale = $request_sale;
    }

    public function render()
    {
        return view('livewire.pages.sale.show')->extends('layouts.app')->section('wrapper');
    }
}

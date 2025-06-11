<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pages\Purchase;

use Livewire\Component;
use App\Models\Purchase;

class Show extends Component
{
    public Purchase $purchase;

    public function mount(Purchase $purchase): void
    {
        $this->purchase = $purchase;
    }

    public function render()
    {
        return view('livewire.pages.purchase.show')->extends('layouts.app')->section('wrapper');
    }
}

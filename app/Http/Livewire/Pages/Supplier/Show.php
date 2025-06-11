<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pages\Supplier;

use Livewire\Component;
use App\Models\Supplier;

class Show extends Component
{
    public Supplier $supplier;

    public function mount(Supplier $supplier): void
    {
        $this->supplier = $supplier;
    }

    public function render()
    {
        return view('livewire.pages.supplier.show')->extends('layouts.app')->section('wrapper');
    }
}

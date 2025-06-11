<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pages\Inggridient;

use Livewire\Component;
use App\Models\MasterInggridient;

class Show extends Component
{
    public MasterInggridient $master_inggridient;

    public function mount(MasterInggridient $master_inggridient): void
    {
        $this->master_inggridient = $master_inggridient;
    }

    public function render()
    {
        return view('livewire.pages.inggridient.show')->extends('layouts.app')->section('wrapper');
    }
}

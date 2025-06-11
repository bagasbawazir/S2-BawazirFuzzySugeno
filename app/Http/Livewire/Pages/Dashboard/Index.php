<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pages\Dashboard;

use Livewire\Component;
use App\Models\InggridientHistory;
use App\Models\MasterInggridient;

class Index extends Component
{
    public function mount(): void
    {
    }

    public function render()
    {
        $this->dispatchBrowserEvent('destroy');
        $this->dispatchBrowserEvent('initSomething');
        return view('livewire.pages.dashboard.index')->extends('layouts.app')->section('wrapper');
    }
    public function submit()
    {
    }
}

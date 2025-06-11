<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pages\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Show extends Component
{
    public Role $role;

    public function mount(Role $role): void
    {
        $this->role = $role;
    }

    public function render()
    {
        return view('livewire.pages.role.show')->extends('layouts.app')->section('wrapper');
    }
}

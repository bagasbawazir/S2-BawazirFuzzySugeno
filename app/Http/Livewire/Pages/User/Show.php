<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pages\User;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public User $user;

    public function mount(User $user): void
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.pages.user.show')->extends('layouts.app')->section('wrapper');
    }
}

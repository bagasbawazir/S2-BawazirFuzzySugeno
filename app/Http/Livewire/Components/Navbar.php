<?php

declare(strict_types=1);

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Traits\LogoutTrait;

class Navbar extends Component
{
    use LogoutTrait;

    public function render()
    {
        return view('livewire.components.navbar');
    }
}

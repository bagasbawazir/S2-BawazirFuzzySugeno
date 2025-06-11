<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Login extends Component
{
    use LivewireAlert;

    public $username;
    public $password;

    protected $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    public function login()
    {
        $credentials = $this->validate();

        if (auth()->attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            return redirect()->route('dashboard');
        }

        $this->alert('error', 'Failed to Login', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Your Username or Password is wrong!.',
            'width' => '400',
        ]);
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.app-login')->section('form-login');
    }
}

<?php

declare(strict_types=1);

namespace App\Traits;

use Jantinnerezo\LivewireAlert\LivewireAlert;

trait LogoutTrait
{
    use LivewireAlert;

    public function logout(): void
    {
        auth()->logout();

        $this->flash('success', 'Successful Logout', [
            'position' => 'top-end',
            'timer' => 7000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'You have logged out of the system.',
        ], route('auth.login'));
    }
}

<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UserObserver
{
    use LivewireAlert;

    /**
     * Handle the User "created" event.
     *
     * @return void
     */
    public function created(User $user): void
    {
        $this->flash('success', 'Successfully Added Data', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'User data added successfully.',
        ], route('user.index'));
    }

    /**
     * Handle the User "updated" event.
     *
     * @return void
     */
    public function updated(User $user): void
    {
        $this->flash('success', 'successfully Changed Data', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'User data successfully changed.',
        ], route('user.index'));
    }

    /**
     * Handle the User "deleted" event.
     *
     * @return void
     */
    public function deleted(User $user): void
    {
        $this->flash('success', 'Successfully Deleting Data', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'User data has been successfully deleted.',
        ], route('user.index'));
    }

    /**
     * Handle the User "restored" event.
     *
     * @return void
     */
    public function restored(User $user): void
    {

    }

    /**
     * Handle the User "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(User $user): void
    {

    }
}

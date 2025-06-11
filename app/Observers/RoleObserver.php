<?php

declare(strict_types=1);

namespace App\Observers;

use Spatie\Permission\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class RoleObserver
{
    use LivewireAlert;

    /**
     * Handle the Role "created" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function created(Role $role): void
    {
        $this->flash('success', 'Successfully Added Data', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Role data added successfully.',
        ], route('role.index'));
    }

    /**
     * Handle the Role "updated" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function updated(Role $role): void
    {
        $this->flash('success', 'successfully Changed Data', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Role data successfully changed.',
        ], route('role.index'));
    }

    /**
     * Handle the Role "deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function deleted(Role $role): void
    {
        $this->flash('success', 'Successfully Deleting Data', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Role data has been successfully deleted.',
        ], route('role.index'));
    }

    /**
     * Handle the Role "restored" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function restored(Role $role): void
    {

    }

    /**
     * Handle the Role "force deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function forceDeleted(Role $role): void
    {

    }
}

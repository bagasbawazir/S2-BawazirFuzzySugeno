<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Supplier;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SupplierObserver
{
    use LivewireAlert;

    /**
     * Handle the Supplier "created" event.
     *
     * @return void
     */
    public function created(Supplier $supplier): void
    {
        $this->flash('success', 'Successfully Added Data', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Supplier data added successfully.',
        ], route('supplier.index'));
    }

    /**
     * Handle the Supplier "updated" event.
     *
     * @return void
     */
    public function updated(Supplier $supplier): void
    {
        $this->flash('success', 'successfully Changed Data', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Supplier data successfully changed.',
        ], route('supplier.index'));
    }

    /**
     * Handle the Supplier "deleted" event.
     *
     * @return void
     */
    public function deleted(Supplier $supplier): void
    {
        $this->flash('success', 'Successfully Deleting Data', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Supplier data has been successfully deleted.',
        ], route('supplier.index'));
    }

    /**
     * Handle the Supplier "restored" event.
     *
     * @return void
     */
    public function restored(Supplier $supplier): void
    {

    }

    /**
     * Handle the Supplier "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Supplier $supplier): void
    {

    }
}

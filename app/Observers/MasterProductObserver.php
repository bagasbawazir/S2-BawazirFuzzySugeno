<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\MasterProduct;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MasterProductObserver
{
    use LivewireAlert;

    /**
     * Handle the MasterProduct "created" event.
     *
     * @return void
     */
    public function created(MasterProduct $masterProduct): void
    {
        $this->flash('success', 'Successfully Added Data', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Product data added successfully.',
        ], route('master_product.index'));
    }

    /**
     * Handle the MasterProduct "updated" event.
     *
     * @return void
     */
    public function updated(MasterProduct $masterProduct): void
    {
        $this->flash('success', 'successfully Changed Data', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Product data successfully changed.',
        ], route('master_product.index'));
    }

    /**
     * Handle the MasterProduct "deleted" event.
     *
     * @return void
     */
    public function deleted(MasterProduct $masterProduct): void
    {
        $this->flash('success', 'Successfully Deleting Data', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Product data has been successfully deleted.',
        ], route('master_product.index'));
    }

    /**
     * Handle the MasterProduct "restored" event.
     *
     * @return void
     */
    public function restored(MasterProduct $masterProduct): void
    {

    }

    /**
     * Handle the MasterProduct "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(MasterProduct $masterProduct): void
    {

    }
}

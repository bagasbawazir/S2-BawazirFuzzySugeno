<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Purchase;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PurchaseObserver
{
    use LivewireAlert;

    /**
     * Handle the Purchase "created" event.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return void
     */
    public function created(Purchase $purchase): void
    {
        $this->flash('success', 'Successfully Transaction', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Purchase Transaction has been successful.',
        ], route('purchase.index'));
    }

    /**
     * Handle the Purchase "updated" event.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return void
     */
    public function updated(Purchase $purchase): void
    {

    }

    /**
     * Handle the Purchase "deleted" event.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return void
     */
    public function deleted(Purchase $purchase): void
    {

    }

    /**
     * Handle the Purchase "restored" event.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return void
     */
    public function restored(Purchase $purchase): void
    {

    }

    /**
     * Handle the Purchase "force deleted" event.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return void
     */
    public function forceDeleted(Purchase $purchase): void
    {

    }
}

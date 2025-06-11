<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\RequestSale;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class RequestSaleObserver
{
    use LivewireAlert;

    /**
     * Handle the RequestSale "created" event.
     *
     * @param  \App\Models\RequestSale  $requestSale
     * @return void
     */
    public function created(RequestSale $requestSale): void
    {
        $this->flash('success', 'Successfully Transaction', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Sale Transaction has been successful.',
        ], route('sale.index'));
    }

    /**
     * Handle the RequestSale "updated" event.
     *
     * @param  \App\Models\RequestSale  $requestSale
     * @return void
     */
    public function updated(RequestSale $requestSale): void
    {

    }

    /**
     * Handle the RequestSale "deleted" event.
     *
     * @param  \App\Models\RequestSale  $requestSale
     * @return void
     */
    public function deleted(RequestSale $requestSale): void
    {

    }

    /**
     * Handle the RequestSale "restored" event.
     *
     * @param  \App\Models\RequestSale  $requestSale
     * @return void
     */
    public function restored(RequestSale $requestSale): void
    {

    }

    /**
     * Handle the RequestSale "force deleted" event.
     *
     * @param  \App\Models\RequestSale  $requestSale
     * @return void
     */
    public function forceDeleted(RequestSale $requestSale): void
    {

    }
}

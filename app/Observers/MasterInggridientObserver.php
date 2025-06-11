<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\MasterInggridient;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MasterInggridientObserver
{
    use LivewireAlert;

    /**
     * Handle the MasterInggridient "created" event.
     *
     * @return void
     */
    public function created(MasterInggridient $masterInggridient): void
    {
        $this->flash('success', 'Successfully Added Data', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Inggridient data added successfully.',
        ], route('master_inggridient.index'));
    }

    /**
     * Handle the MasterInggridient "updated" event.
     *
     * @return void
     */
    public function updated(MasterInggridient $masterInggridient): void
    {
        $this->flash('success', 'successfully Changed Data', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Inggridient data successfully changed.',
        ], route('master_inggridient.index'));
    }

    /**
     * Handle the MasterInggridient "deleted" event.
     *
     * @return void
     */
    public function deleted(MasterInggridient $masterInggridient): void
    {
        $this->flash('success', 'Successfully Deleting Data', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Inggridient data has been successfully deleted.',
        ], route('master_inggridient.index'));
    }

    /**
     * Handle the MasterInggridient "restored" event.
     *
     * @return void
     */
    public function restored(MasterInggridient $masterInggridient): void
    {

    }

    /**
     * Handle the MasterInggridient "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(MasterInggridient $masterInggridient): void
    {

    }
}

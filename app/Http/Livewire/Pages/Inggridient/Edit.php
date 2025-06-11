<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pages\Inggridient;

use Livewire\Component;
use App\Models\MasterInggridient;

class Edit extends Component
{
    public $selected = '';

    public MasterInggridient $master_inggridient;

    public function mount(MasterInggridient $master_inggridient): void
    {
        $this->master_inggridient = $master_inggridient;
        $this->selected = $this->master_inggridient->unit_inggridient;
    }

    public function render()
    {
        return view('livewire.pages.inggridient.edit')->extends('layouts.app')->section('wrapper');
    }

    public function submit(): void
    {
        $this->validate();

        $this->master_inggridient->unit_inggridient = $this->selected;

        $this->master_inggridient->save();
    }

    protected function rules(): array
    {
        return [
            'master_inggridient.name_inggridient' => [
                'required',
            ],
            'master_inggridient.price_inggridient' => [
                'required',
                'numeric',
            ],
        ];
    }
}

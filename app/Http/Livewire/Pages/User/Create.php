<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pages\User;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;

    public User $user;

    public array $roles = [];
    public array $listsForFields = [];

    public string $password = '';

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.pages.user.create')->extends('layouts.app')->section('wrapper');
    }

    public function submit(): void
    {
        $this->validate();

        $this->user->password = $this->password;

        $this->user->save();
        $this->user->roles()->sync($this->roles);
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['roles'] = Role::pluck('name', 'id');
    }

    protected function rules(): array
    {
        return [
            'user.fullname' => [
                'string',
                'required',
            ],
            'user.username' => [
                'required',
                'unique:users,username',
            ],
            'password' => [
                'required',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'roles.*.id' => [
                'integer',
                'exists:roles,id',
            ],
        ];
    }
}

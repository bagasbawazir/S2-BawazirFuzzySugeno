<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pages\User;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public User $user;

    public array $roles = [];
    public array $listsForFields = [];

    public string $password = '';

    public function mount(user $user): void
    {
        $this->user = $user;
        $this->roles = $this->user->roles()->pluck('id')->toArray();
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.pages.user.edit')->extends('layouts.app')->section('wrapper');
    }

    public function submit()
    {
        $this->validate();

        $this->user->password = $this->password;

        $this->user->save();
        $this->user->roles()->sync($this->roles);

        return redirect()->route('user.index');
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
                'unique:users,username,' . $this->user->id_user . ',id_user',
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

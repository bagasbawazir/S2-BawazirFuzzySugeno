<?php

declare(strict_types=1);

namespace App\Http\Livewire\Pages\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;

    public Role $role;

    public array $permissions = [];
    public array $listsForFields = [];

    public function mount(Role $role): void
    {
        $this->role = $role;
        $this->permissions = $this->role->permissions()->pluck('id')->toArray();
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.pages.role.edit')->extends('layouts.app')->section('wrapper');
    }

    public function submit()
    {
        $this->validate();

        $this->role->save();
        $this->role->syncPermissions($this->permissions);

        return redirect()->route('role.index');
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['permissions'] = Permission::pluck('name', 'id');
    }

    protected function rules(): array
    {
        return [
            'role.name' => [
                'string',
                'required',
            ],
            'permissions' => [
                'required',
                'array',
            ],
            'permissions.*.id' => [
                'integer',
                'exists:permissions,id',
            ],
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\Pages\Role\Edit;
use App\Http\Livewire\Pages\Role\Show;
use App\Http\Livewire\Pages\Role\Index;
use App\Http\Livewire\Pages\Role\Create;

class RoleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('roles_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Index::class);
    }

    public function create()
    {
        abort_if(Gate::denies('roles_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Create::class);
    }

    public function show(Role $role)
    {
        abort_if(Gate::denies('roles_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Show::class)->with(compact('role'));
    }

    public function edit(role $role)
    {
        abort_if(Gate::denies('roles_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Edit::class)->with(compact('role'));
    }
}

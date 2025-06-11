<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\Pages\User\Edit;
use App\Http\Livewire\Pages\User\Show;
use App\Http\Livewire\Pages\User\Index;
use App\Http\Livewire\Pages\User\Create;

class UserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('users_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Index::class);
    }

    public function create()
    {
        abort_if(Gate::denies('users_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Create::class);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('users_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_with_roles = $user->with(['roles' => function ($query): void {
            $query->select('id', 'name');
        }])->get();

        return App::call(Show::class)->with(compact('user_with_roles'));
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('users_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Edit::class)->with(compact('user'));
    }
}

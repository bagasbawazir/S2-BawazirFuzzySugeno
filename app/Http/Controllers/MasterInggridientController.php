<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Response;
use App\Models\MasterInggridient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\Pages\Inggridient\Edit;
use App\Http\Livewire\Pages\Inggridient\Show;
use App\Http\Livewire\Pages\Inggridient\Index;
use App\Http\Livewire\Pages\Inggridient\Create;

class MasterInggridientController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('master_inggridients_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Index::class);
    }

    public function create()
    {
        abort_if(Gate::denies('master_inggridients_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Create::class);
    }

    public function show(MasterInggridient $master_inggridient)
    {
        abort_if(Gate::denies('master_inggridients_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Show::class)->with(compact('master_inggridient'));
    }

    public function edit(MasterInggridient $master_inggridient)
    {
        abort_if(Gate::denies('master_inggridients_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Edit::class)->with(compact('master_inggridient'));
    }
}

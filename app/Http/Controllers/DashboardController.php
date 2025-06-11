<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\Pages\Dashboard\Index;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('master_inggridients_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Index::class);
    }
}

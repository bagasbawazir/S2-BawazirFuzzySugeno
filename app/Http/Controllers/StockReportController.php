<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Artisan;
use App\Http\Livewire\Pages\StockReport\Index;
use App\Http\Livewire\Pages\StockReport\Stockreport;

class StockReportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('master_inggridients_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Index::class);
    }

    public function show()
    {
        abort_if(Gate::denies('master_inggridients_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Stockreport::class);
    }
}

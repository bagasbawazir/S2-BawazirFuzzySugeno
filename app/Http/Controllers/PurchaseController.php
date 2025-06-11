<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\Pages\Purchase\Show;
use App\Http\Livewire\Pages\Purchase\Index;
use App\Http\Livewire\Pages\Purchase\Create;
use App\Http\Livewire\Pages\Purchase\Recap;

class PurchaseController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('purchases_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Index::class);
    }

    public function create()
    {
        abort_if(Gate::denies('purchases_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Create::class);
    }

    public function show(Purchase $purchase)
    {
        abort_if(Gate::denies('purchases_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Show::class)->with(compact('purchase'));
    }

    public function recap()
    {

        abort_if(Gate::denies('master_inggridients_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Recap::class);
    }
}

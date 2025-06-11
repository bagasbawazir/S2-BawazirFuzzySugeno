<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\MasterProduct;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\Pages\Product\Edit;
use App\Http\Livewire\Pages\Product\Show;
use App\Http\Livewire\Pages\Product\Index;
use App\Http\Livewire\Pages\Product\Create;

class MasterProductController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('master_products_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Index::class);
    }

    public function create()
    {
        abort_if(Gate::denies('master_products_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Create::class);
    }

    public function show(MasterProduct $master_product)
    {
        abort_if(Gate::denies('master_products_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Show::class)->with(compact('master_product'));
    }

    public function edit(MasterProduct $master_product)
    {
        abort_if(Gate::denies('master_products_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Edit::class)->with(compact('master_product'));
    }
}

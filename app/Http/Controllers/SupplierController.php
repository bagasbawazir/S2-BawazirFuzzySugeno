<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\Pages\Supplier\Edit;
use App\Http\Livewire\Pages\Supplier\Show;
use App\Http\Livewire\Pages\Supplier\Index;
use App\Http\Livewire\Pages\Supplier\Create;

class SupplierController extends Controller
{
    public function index()
    {
        // batalkan jika hak akses user tidak memiliki ke supplier access
        abort_if(Gate::denies('suppliers_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //  memanggil kelas index use App\Http\Livewire\Pages\Supplier\Index;
        return App::call(Index::class);
    }

    public function create()
    {
        abort_if(Gate::denies('suppliers_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Create::class);
    }

    public function show(Supplier $supplier)
    {
        abort_if(Gate::denies('suppliers_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Show::class)->with(compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        abort_if(Gate::denies('suppliers_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Edit::class)->with(compact('supplier'));
    }
}

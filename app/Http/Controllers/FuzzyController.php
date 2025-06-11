<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Artisan;
use App\Http\Livewire\Pages\Fuzzy\Index;
use App\Http\Livewire\Pages\Fuzzy\Fuzzyfication;
use App\Http\Livewire\Pages\Fuzzy\Rules;
use App\Http\Livewire\Pages\Fuzzy\Defuzzyfication;

class FuzzyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('master_inggridients_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Index::class);
    }

    public function fuzzyfication()
    {
        abort_if(Gate::denies('master_inggridients_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Fuzzyfication::class);
    }
    public function rules()
    {
        abort_if(Gate::denies('master_inggridients_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Rules::class);
    }
    public function deffuzyfication()
    {
        abort_if(Gate::denies('master_inggridients_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return App::call(Defuzzyfication::class);
    }
}

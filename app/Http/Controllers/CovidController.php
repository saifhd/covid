<?php

namespace App\Http\Controllers;

use App\Models\CovidCase;
use App\Models\CovidTest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CovidController extends Controller
{
    public function __invoke()
    {
        $covidCase = CovidCase::latest()->first()->toArray();
        $covidTests = CovidTest::query()
            ->orderByDesc('date')
            ->paginate();
            
        return view('covid.index',[
            'covidCase' => Arr::except($covidCase,['id' ,'created_at', 'updated_at']),
            'covidTests' => $covidTests
        ]);
    }
}

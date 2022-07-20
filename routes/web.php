<?php

use App\Http\Controllers\CovidController;
use App\Http\Controllers\HelpAndGuidController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/', CovidController::class)->name('covid.index');

Route::controller(HelpAndGuidController::class)
    ->prefix('help-and-guids')
    ->group(function(){
        Route::get('/','index')->name('help-and-guid.index');
        Route::post('/','store')->middleware('auth')->name('help-and-guid.store');
    });

require __DIR__.'/auth.php';

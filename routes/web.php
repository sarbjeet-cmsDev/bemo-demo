<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
Route::get('/{any}', function () {
    return view('app'); // Blade view that loads Vue
})->where('any', '.*');

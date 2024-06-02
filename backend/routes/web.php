<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::group(['prefix' => 'api'], function () {
//     Route::post('/register', [RegisterController::class, 'store']);
// });

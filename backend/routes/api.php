<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::POST('/register', [RegisterController::class, 'store']);
Route::POST('/login', [LoginController::class, 'login']);
Route::GET('/category', [CategoryController::class, 'index']);
Route::GET('/category/{id}/products', [CategoryController::class, 'products']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    /** Admin Role */
    Route::group(['middleware' => 'role:admin'], function () {

        /** Category */
        Route::POST('/category', [CategoryController::class, 'store']);
        Route::PUT('/category/{id}', [CategoryController::class, 'update']);
        Route::DELETE('/category/{id}', [CategoryController::class, 'destroy']);

        /** Product */
        Route::POST('/product', [ProductController::class, 'store']);
        Route::PUT('/product/{id}', [ProductController::class, 'update']);
        Route::DELETE('/product/{id}', [ProductController::class, 'destroy']);
    });

    /** Member Role */
    Route::group(['middleware' => 'role:member'], function () {
        Route::GET('/basket', [BasketController::class, 'index']);
        Route::GET('/basket/add-product/{productId}', [BasketController::class, 'addProduct']);
        Route::DELETE('/basket/delete-product/{productId}', [BasketController::class, 'deleteProduct']);
    });
});

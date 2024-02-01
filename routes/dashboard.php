<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;



Route::group([
    'middleware' => ['auth'],
    'as'=>'dashboard.',  // this closure mean that all routes names will be started with dashboard.
    'prefix'=>'dashboard' // this closure mean that all routes will be started by dashboard , / >> /dashboard

], function () {

    Route::get('/categories/trash',[CategoriesController::class,'trash'])
        ->name('categories.trash');
    Route::put('/categories/{category}/trash',[CategoriesController::class,'restore'])
        ->name('categories.restore');
    Route::delete('/categories/{category}/force-delete',[CategoriesController::class,'forceDelete'])
        ->name('categories.force-delete');


    Route::get('/', [DashboardController::class, 'index'])
        ->middleware(['verified'])
        ->name('dashboard');

    Route::resource('/categories', CategoriesController::class);
});


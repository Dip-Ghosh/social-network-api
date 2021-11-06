<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Page\PageController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {

    //login registration route
    Route::group(['prefix' => 'auth','as'=>'auth.'],function(){
        Route::post('register', [AuthController::class, 'register'])->name('registration');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    });

    //page create route
    Route::post('page/create', [PageController::class, 'createPage'])->middleware('auth:api')->name('pages.create');


});

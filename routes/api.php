<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Feed\FeedController;
use App\Http\Controllers\Api\Follower\FollowerController;
use App\Http\Controllers\Api\Page\PageController;
use App\Http\Controllers\Api\Post\PostController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {

    //login registration route
    Route::group(['prefix' => 'auth','as'=>'auth.'],function(){
        Route::post('register',[AuthController::class, 'register'])->name('registration');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');

    });

    Route::middleware('auth:api')->group(function () {

        //page create route
        Route::post('page/create', [PageController::class, 'createPage'])->name('pages.create');

        //following route
        Route::group(['prefix' => 'follow', 'as' => 'follow.'], function () {
            Route::post('person', [FollowerController::class, 'followPerson'])->name('persons');
            Route::post('page', [FollowerController::class, 'followPage'])->name('pages');
        });

        //publish post route
        Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
            Route::post('publish/person', [PostController::class, 'postPublishedByPerson'])->name('publish.persons');
            Route::post('publish/{pageId}/page', [PostController::class, 'postPublishedByPersonFromPage'])->name('publish.pages');
        });
        Route::get('person/feed', [FeedController::class, 'index'])->name('persons.feed');
    });

});

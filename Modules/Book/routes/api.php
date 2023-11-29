<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Book\app\Http\Controllers\BookController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::controller(BookController::class)->group(function(){
    Route::group(['prefix'=>'books'],function(){
        Route::get('/','index');
        Route::get('/{id}','show');
        Route::post('/','store');
        Route::patch('/{id}','update');
        Route::delete('/{id}','destroy');
        Route::post('/author','setBookAuthor');
        Route::post('/author.delete','deleteBookAuthor');
        Route::post('/author/{id}','updateBookAuthor');
    });
});
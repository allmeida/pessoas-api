<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('API')->name('api.')->group(function(){
    Route::prefix('pessoas')->group(function(){
        Route::get('/', 'PessoaController@index');
        Route::get('/{id}', 'PessoaController@show');

        Route::post('/', 'PessoaController@store');
        Route::put('/{id}', 'PessoaController@update');

        Route::delete('/{id}', 'PessoaController@delete');
    });
});
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/retrieve', [ 'uses' => '\App\Http\Controllers\RetrievePeoples@peopleFromSource']);
//React.js
Route::get('/people', function () { return view('people'); });
//Route::get('/table', function () { return view('table'); });

//API
Route::group(['prefix' => '/api'], function (){
    Route::get('/people', [ 'uses' => '\App\Http\Controllers\PeopleController@list']);
    Route::get('/people/{peopleId}', [ 'uses' => '\App\Http\Controllers\PeopleController@list']);
    //Route::get('/api/people/{peopleId}', [ 'uses' => '\App\Http\Controllers\PeopleControllers@details']);
});

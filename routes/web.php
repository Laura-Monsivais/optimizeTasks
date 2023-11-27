<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/families', [App\Http\Controllers\FamilyController::class, 'index']);

Route::get('/index', 'App\Http\Controllers\FamilyController@index');
Route::get('/stateID/{ID}', 'App\Http\Controllers\FamilyController@getStateID');
Route::post('/', 'App\Http\Controllers\FamilyController@registerFamily');

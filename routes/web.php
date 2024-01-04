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


//Route::post('/', 'FamilyController@import')->name('importData');
//Route::get('/posts', 'FamilyController@index')->name('posts');
//Route::get('/families', [App\Http\Controllers\FamilyController::class, 'index'])->name('import');
Route::get('/',  [App\Http\Controllers\FamilyController::class, 'import'])->name('import');




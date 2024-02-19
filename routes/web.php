<?php

use App\Http\Controllers\FamilyController;
use App\Http\Controllers\PersonsController;
use App\Http\Controllers\StudentsController;
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
Route::get('/', [FamilyController::class, 'showImport'])->name('showImport');
Route::post('/import', [FamilyController::class, 'uploadImport'])->name('uploadImport');
Route::post('/separateSurnames', [FamilyController::class, 'separateSurnames']);
Route::post('/separateAddress', [FamilyController::class, 'separateAddress'])->name('address');
Route::post('/GenderStudents', [StudentsController::class, 'GenderStudents'])->name('S_Gender');
Route::post('/StudentsCurp', [StudentsController::class, 'StudentsCurp'])->name('S_curp');
Route::post('/PersonsGender', [PersonsController::class, 'PersonsGender'])->name('P_Gender');
Route::post('/PersonsCurp', [PersonsController::class, 'PersonsCurp'])->name('P_curp');
Route::post('/store', [FamilyController::class, 'store'])->name('store');
Route::post('/getStateID', [FamilyController::class, 'getStateID'])->name('getStateID');
Route::post('/getCountryID', [FamilyController::class, 'getCountryID'])->name('getCountryID');
Route::post('/index', [FamilyController::class, 'index'])->name('index');
Route::post('/validatePhone', [FamilyController::class, 'phone'])->name('validatePhone');




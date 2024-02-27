<?php

use App\Http\Controllers\FamilyController;
use App\Http\Controllers\MainController;
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
Route::get('/', [MainController::class, 'showImport'])->name('showImport');
Route::post('/import', [MainController::class, 'uploadImport'])->name('uploadImport');


/* Familias */
Route::get('/families', [FamilyController::class, 'index']);
Route::post('/families/create', [FamilyController::class, 'store']);
Route::post('/families/separateSurnames', [FamilyController::class, 'separateSurnames']);
Route::post('/families/separateAddress', [FamilyController::class, 'separateAddress']);
Route::get('/families/{StateID}', [FamilyController::class, 'getStateID']);
Route::get('/families/{CountryID}', [FamilyController::class, 'getCountryID']);
Route::post('/families/validateNumber', [FamilyController::class, 'validateNumber'])->name('fValidateNumber');;
Route::post('/families/verificationFamID', [FamilyController::class, 'verificationFamID']);


/* Alumnos */
Route::get('/students', [StudentsController::class, 'index']);
Route::post('/students/create', [StudentsController::class, 'store']);
Route::post('/students/validateGender', [StudentsController::class, 'validateGender']);
Route::post('/students/validateCurp', [StudentsController::class, 'validateCurp']);


/* Personas */
Route::get('/persons', [PersonsController::class, 'index']);
Route::post('/persons/create', [PersonsController::class, 'store']);
Route::post('/persons/validateGender', [PersonsController::class, 'validateGender']);
Route::post('/persons/validateCurp', [PersonsController::class, 'validateCurp']);




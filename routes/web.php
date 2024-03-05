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
Route::get('/import/table', [MainController::class, 'showTableImport'])->name('showTableImport');
Route::get('/check-updates', [MainController::class, 'checkUpdates']);


/* Familias */
Route::get('/families', [FamilyController::class, 'index']);
Route::post('/families/create/{ID}', [FamilyController::class, 'store']);
Route::post('/families/separateSurnames', [FamilyController::class, 'separateSurnames']);
Route::post('/families/separateAddress', [FamilyController::class, 'separateAddress']);
Route::get('/families/getStateID/{StateID}', [FamilyController::class, 'getStateID']);
Route::get('/families/getCountryID/{CountryID}', [FamilyController::class, 'getCountryID']);
Route::post('/families/validateNumber', [FamilyController::class, 'validateNumber'])->name('fValidateNumber');;
Route::post('/families/verificationFamID', [FamilyController::class, 'verificationFamID']);


/* Alumnos */
Route::get('/students', [StudentsController::class, 'index']);
Route::post('/students/create', [StudentsController::class, 'store']);
Route::post('/students/separateFullName', [StudentsController::class, 'separateFullName']);
Route::post('/students/validateGender', [StudentsController::class, 'validateGender']);
Route::post('/students/validateCurp', [StudentsController::class, 'validateCurp']);
Route::get('/students/getMaritalStatusID/{MaritalStatusID}', [StudentsController::class, 'getMaritalStatusID']);
Route::get('/students/getBirthPlaceID/{BirthPlaceID}', [StudentsController::class, 'getBirthPlaceID']);
Route::get('/students/getNationalityID/{NationalityID}', [StudentsController::class, 'getNationalityID']);
Route::get('/students/getReligionID/{ReligionID}', [StudentsController::class, 'getReligionID']);

/* Personas */
Route::get('/persons', [PersonsController::class, 'index']);
Route::post('/persons/create', [PersonsController::class, 'store']);
Route::post('/persons/validateGender', [PersonsController::class, 'validateGender']);
Route::post('/persons/validateCurp', [PersonsController::class, 'validateCurp']);

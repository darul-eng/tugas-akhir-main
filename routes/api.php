<?php

use App\Http\Controllers\DokumenController;
use App\Http\Controllers\FormalEducationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HumanResourceController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);
Route::get('sumberDayaManusia', [HumanResourceController::class, 'getAll']);
Route::get('sumberDayaManusia/{id_sdm}', [HumanResourceController::class, 'getByID']);
Route::get('pendidikanFormal', [FormalEducationController::class, 'getAll']);
Route::get('pendidikanFormal/{id_sdm}', [FormalEducationController::class, 'getByIDSdm']);
Route::get('dokumen/{id_sdm}', [DokumenController::class, 'getByIDSdm']);
Route::post('dokumen/{id_sdm}', [DokumenController::class, 'uploadDokumenSDM']);
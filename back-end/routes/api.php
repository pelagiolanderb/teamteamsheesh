<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//Router for PatientController
Route::get('patient-list', [PatientController::class, 'index']);
Route::post('patient-list', [PatientController::class, 'store']);
Route::put('patient-list/update/{id}', [PatientController::class, 'update']);
Route::delete('patient-list/delete/{id}', [PatientController::class, 'delete']);

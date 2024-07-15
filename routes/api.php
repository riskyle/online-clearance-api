<?php

use App\Http\Controllers\Api\V1\SchoolPersonnelController;
use App\Http\Controllers\Api\V1\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ClearanceController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\Request;

Route::middleware(['auth:sanctum'])->get('/user', fn (Request $request) =>  new UserResource($request->user()));

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {

    Route::apiResource('profiles', ProfileController::class);

    Route::apiResource('students', StudentController::class)->parameter('students', 'user');

    Route::apiResource('school-personnels', SchoolPersonnelController::class)->parameter('school-personnels', 'user');

    Route::apiResource('clearances', ClearanceController::class)->except('store');

    Route::post('clearances/{student}', [ClearanceController::class, 'store']);

    Route::post('clearances/bulk', [ClearanceController::class, 'bulkStoreClearance']);
});

<?php

use App\Http\Controllers\Api\V1\SchoolPersonnelController;
use App\Http\Controllers\Api\V1\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ClearanceController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\Request;

/* 
#TODO

TO BE REMEBERED!!!

to register the students on this system
what will we do is to register them using the google form
and then store it in the excel and turn it in into CSV file
then we create a import feature to this system that when uploading a csv file it will upload
the data into the database 

*/

Route::middleware(['auth:sanctum', 'verified'])->get('/user', fn(Request $request) =>  new UserResource($request->user()));

Route::middleware(['auth:sanctum', 'verified'])->prefix('v1')->group(function () {

    Route::apiResource('profiles', ProfileController::class);

    Route::apiResource('students', StudentController::class)->parameter('students', 'user');

    Route::apiResource('school-personnels', SchoolPersonnelController::class)->parameter('school-personnels', 'user');

    Route::apiResource('clearances', ClearanceController::class)->except('store');

    Route::post('clearances/{student}', [ClearanceController::class, 'store']);

    Route::post('clearances/bulk', [ClearanceController::class, 'bulkStoreClearance']);
});

<?php

use App\Http\Controllers\Api\V1\SchoolPersonnelController;
use App\Http\Controllers\Api\V1\StudentController;
use App\Http\Resources\V1\StudentCollection;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return auth()->user();
});

Route::prefix('v1')->group(function () {

    Route::apiResource('students', StudentController::class);

    Route::post('students/upload-profile-picture/{user}', [StudentController::class, 'updateProfilePicture']);

    Route::apiResource('school-personnels', SchoolPersonnelController::class);

    Route::post('school-personnels/upload-profile-picture/{user}', [SchoolPersonnelController::class, 'updateProfilePicture']);
});

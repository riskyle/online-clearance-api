<?php

use App\Http\Controllers\Api\V1\SchoolPersonnelController;
use App\Http\Controllers\Api\V1\StudentController;
use App\Http\Resources\V1\SchoolPersonnelResource;
use App\Http\Resources\V1\StudentResource;
use App\Models\SchoolPersonnel;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {

    if (auth()->user()->role_id != 3) {

        $sp = new SchoolPersonnel;

        $user = new SchoolPersonnelResource($sp->with('user')->where('user_id', auth()->user()->id)->first());

        return $user;
    }

    $student = new Student;

    $user = new StudentResource($student->with('user')->where('user_id', auth()->user()->id)->first());

    return $user;
});

Route::prefix('v1')->group(function () {

    Route::apiResource('students', StudentController::class);

    Route::post('students/upload-profile-picture/{user}', [StudentController::class, 'updateProfilePicture']);

    Route::apiResource('school-personnels', SchoolPersonnelController::class);

    Route::post('school-personnels/upload-profile-picture/{user}', [SchoolPersonnelController::class, 'updateProfilePicture']);
});

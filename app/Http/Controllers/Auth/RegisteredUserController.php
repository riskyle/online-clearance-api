<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\V1\StudentResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreStudentRequest $request) //: Response
    {
        $roleId = 3;

        $user = User::create([
            'role_id' => $roleId,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
        ]);

        return new StudentResource($user->student()->create([
            'lrn' => $request->lrn,
            'student_firstname' => $request->studentFirstname,
            'student_middlename' => $request->studentMiddlename,
            'student_lastname' => $request->studentLastname,
            'student_section' => $request->studentSection,
            'student_year_level' => $request->studentYearLevel,
            'student_type' => $request->studentType,
        ]));

        // event(new Registered($user));

        // Auth::login($user);

        // return response()->noContent();
    }
}

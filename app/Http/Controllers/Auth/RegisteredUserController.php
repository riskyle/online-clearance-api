<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    protected int $roleId = 3;

    public function store(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'role_id' => $this->roleId,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $filteredArray = Arr::except($request->all(), $this->excluded());

        $user->student()->create($filteredArray);

        $token = $request->user()->createToken('auth-token');

        return response()->json([
            "user" => new UserResource($user->findStudentUser($user->id)),
            "token" => $token->plainTextToken
        ]);
    }

    public function excluded(): array
    {
        return [
            'email',
            'password',
            'password_confirmation',
            'passwordConfirmation',
            'studentFirstname',
            'studentMiddleName',
            'studentLastname',
            'studentSex',
            'studentYearLevel',
            'studentSection',
            'studentType',
            'studentMobileNumber',
            'studentAddress',
            'studentAge',
            'studentBirthdate',
            'studentReligion',
            'studentCivilStatus',
            'studentFatherName',
            'studentMotherName',
            'studentGuardianName',
        ];
    }
}

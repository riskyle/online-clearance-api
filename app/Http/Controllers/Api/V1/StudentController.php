<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\User;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private int $roleId = 3;

    public function index(User $user, Request $request)
    {
        Gate::authorize('viewAny', $user);

        return new UserCollection($user->getStudentUsers($request->query('includeClearances'))->get());
    }

    public function store(StoreStudentRequest $request, User $user)
    {
        $user = User::create([
            'role_id' => $this->roleId,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
        ]);

        $filteredArray = Arr::except($request->all(), [...$this->excluded(), 'email', 'password']);
    
        $user->student()->create($filteredArray);
        
        return new UserResource($user->findStudentUser($user->id));
    }

    public function show(User $user, Request $request)
    {
        Gate::authorize('view', $user);

        return new UserResource($user->findStudentUser($user->id, $request->query('includeClearances')));
    }

    public function update(User $user, UpdateStudentRequest $request)
    {
        $filteredArray = Arr::except($request->all(), $this->excluded());

        if (!$filteredArray) {
            throw new \ErrorException("Pointless!");
        }

        if (array_key_exists('email', $filteredArray)) {
            $user->update([
                'email' => $filteredArray['email'],
            ]);
        }

        $filteredArray = Arr::except($filteredArray, ['email']);

        if ($filteredArray) {

            $user = $user->findStudentUser($user->id);

            $user->student->update($filteredArray);
        }

        return response()->json(['message' => 'Student Information updated!']);
    }

    public function destroy(User $user)
    {
        Gate::authorize('delete', $user);

        $user->delete();

        return response()->json(['message' => 'Students data has been deleted']);
    }

    public function excluded(): array
    {
        return [
            'password_confirmation',
            'passwordConfirmation',
            'studentFirstname',
            'studentMiddlename',
            'studentLastname',
            'studentMobileNumber',
            'studentYearLevel',
            'studentSection',
            'studentAddress',
            'studentSex',
            'studentAge',
            'studentBirthdate',
            'studentReligion',
            'studentCivilStatus',
            'studentFatherName',
            'studentMotherName',
            'studentGuardianName',
            'studentType',
        ];
    }
}

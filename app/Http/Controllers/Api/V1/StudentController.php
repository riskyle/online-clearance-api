<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\V1\StudentCollection;
use App\Models\User;
use App\Http\Resources\V1\StudentResource;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class StudentController extends Controller
{
    private int $roleId = 3;

    public function index(Student $student)
    {
        return new StudentCollection($student->with('user')->get());
    }

    public function store(StoreStudentRequest $request)
    {
        $user = User::create([
            'role_id' => $this->roleId,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
        ]);

        return new StudentResource($user->student()->create([
            'student_firstname' => $request->studentFirstname,
            'student_middlename' => $request->studentMiddlename ?? null,
            'student_lastname' => $request->studentLastname,
            'student_mobile_number' => $request->studentMobileNumber,
            'student_section' => $request->studentSection,
            'student_year_level' => $request->studentYearLevel,
            'student_type' => $request->studentType,
            'lrn' => $request->lrn,
        ]));
    }

    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    public function update(Student $student, UpdateStudentRequest $request)
    {

        $filteredArray = Arr::except($request->all(), $this->excluded());

        $student->update($filteredArray);

        return response()->json(['message' => 'Student Information updated!']);
    }

    public function updateProfilePicture(User $user, Request $request)
    {

        $request->validate([
            'profilePicture' => ['required', 'sometimes', 'image']
        ]);

        $picture = Storage::disk('public')->put('/profile_pictures', $request->file('profilePicture'));

        $user->update(['profile_picture' => $picture]);

        return response()->json(['message' => 'Profile Picture has been updated!']);
    }

    public function excluded(): array
    {
        return [
            'studentFirstname',
            'studentMiddleName',
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

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSchoolPersonnelRequest;
use App\Http\Resources\V1\SchoolPersonnelCollection;
use App\Http\Resources\V1\SchoolPersonnelResource;
use App\Models\SchoolPersonnel;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class SchoolPersonnelController extends Controller
{
    public function index(SchoolPersonnel $sp)
    {
        return new SchoolPersonnelCollection($sp->with('user')->get());
    }
    public function store(StoreSchoolPersonnelRequest $request)
    {

        $user = User::create([
            'role_id' => $request->roleId,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
        ]);

        $schoolPersonnel = [
            'sp_firstname' => $request->spFirstname,
            'sp_middlename' => $request->spMiddlename,
            'sp_lastname' => $request->spLastname,
            'sp_address' => $request->spAddress,
            'sp_mobile_number' => $request->spMobileNumber,
            'sp_sex' => $request->spSex,
            'sp_age' => $request->spAge,
            'sp_birthdate' => $request->spBirthdate,
            'sp_religion' => $request->spReligion,
            'sp_civil_status' => $request->spCivilStatus,
        ];

        return new SchoolPersonnelResource($user->schoolPersonnel()->create($schoolPersonnel));
    }

    public function updateProfilePicture(User $user, Request $request)
    {

        $request->validate([
            'profilePicture' => ['required', 'sometimes', 'image']
        ]);

        $user->update(['profile_picture' => $request->file('profilePicture')]);

        Storage::disk('public')->put('/profile_pictures', $request->file('profilePicture'));

        return response()->json(['message' => 'Profile Picture has been updated!']);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSchoolPersonnelRequest;
use App\Http\Requests\UpdateSchoolPersonnelRequest;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class SchoolPersonnelController extends Controller
{
    public function index(User $user)
    {
        Gate::authorize('viewAny', $user);

        return new UserCollection($user->schoolPersonnels()->paginate());
    }

    public function store(StoreSchoolPersonnelRequest $request, User $user)
    {
        $user = User::create([
            'role_id' => $request->roleId,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
        ]);

        $user->schoolPersonnel()->create([
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
        ]);

        return new UserResource($user->findSchoolPersonnel($user->id));
    }

    public function show(User $user)
    {
        Gate::authorize('view', $user);

        return new UserResource($user);
    }

    public function update(User $user, UpdateSchoolPersonnelRequest $request)
    {
        $filteredArray = Arr::except($request->all(), $this->excluded());

        if (!$filteredArray) {
            throw new \ErrorException("Pointless!");
        }

        $attr = [];

        foreach ($filteredArray as $attribute => $data) {

            if (!in_array($attribute, ['email', 'role_id'])) {
                continue;
            }

            $attr[$attribute] = $data;
        }

        if ($attr) {
            $user->update($attr);
        }

        $filteredArray = Arr::except($filteredArray, ['email', 'role_id']);

        if ($filteredArray) {

            $user = $user->findSchoolPersonnel($user->id);

            $user->schoolPersonnel->update(Arr::except($filteredArray, ['email', 'role_id']));
        }

        return response()->json(['message' => 'Student Information updated!']);
    }

    public function destroy(User $user)
    {
        Gate::authorize('delete', $user);

        $user->delete();

        return response()->json(['message' => 'School Personnel\'s data has been deleted!']);
    }

    public function excluded(): array
    {
        return [
            'roleId',
            'spFirstname',
            'spMiddlename',
            'spLastname',
            'spAddress',
            'spMobileNumber',
            'spSex',
            'spAge',
            'spBirthdate',
            'spReligion',
            'spCivilStatus',
        ];
    }
}

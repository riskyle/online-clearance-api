<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function store(UpdateProfileRequest $request, User $user)
    {
        $picture = Storage::disk('public')->put('/profile_pictures', $request->file('profilePicture'));

        $user = $user->find(auth()->user()->id);

        $user->update(['profile_picture' => $picture]);

        return response()->json(['message' => 'Profile Picture has been updated!']);
    }
}

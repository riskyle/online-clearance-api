<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     * 
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'emailVerifiedAt' => $this->email_verified_at ?? null,
            'roleId' => $this->role_id,
            'role' => $this->role->role_name ?? $this->role_id,
            'profilePicture' => $this->profile_picture,
            $this->mergeWhen(in_array($this->role_id, [1, 2]), ['schoolPersonnel' => new SchoolPersonnelResource($this->schoolPersonnel)]),
            $this->mergeWhen($this->role_id === 3, ['student' => new StudentResource($this->student)]),
        ];
    }
}

<?php

namespace App\Http\Resources\V1;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchoolPersonnelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'spFirstname' => $this->sp_firstname,
            'spMiddlename' => $this->sp_middlename,
            'spLastname' => $this->sp_lastname,
            'spAddress' => $this->sp_address,
            'spMobileNumber' => $this->sp_mobile_number,
            'spSex' => $this->sp_sex,
            'spAge' => $this->sp_age,
            'spBirthdate' => $this->sp_birthdate,
            'spReligion' => $this->sp_religion,
            'spCivilStatus' => $this->sp_civil_status,
            'user' =>  [
                'id' => $this->user->id,
                'email' => $this->user->email,
                'emailVerifiedAt' => $this->user->email_verified_at,
                'role' => $this->user->role->role_name,
                'roleId' => $this->user->role_id,
                'profilePicture' => $this->user->profile_picture,
            ],
        ];
    }
}

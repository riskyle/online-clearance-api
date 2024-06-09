<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'userId' => $this->user_id,
            'lrn' => $this->lrn,
            'studentFirstname' => $this->student_firstname,
            'studentMiddlename' => $this->student_middlename ?? null,
            'studentLastname' => $this->student_lastname,
            'studentYearLevel' => $this->student_year_level,
            'studentMobileNumber' => $this->student_mobile_number,
            'studentAddress' => $this->student_address,
            'studentSex' => $this->student_sex,
            'studentAge' => $this->student_age,
            'studentBirthdate' => $this->student_birthdate,
            'studentReligion' => $this->student_religion,
            'studentCivilStatus' => $this->student_civil_status,
            'studentFatherName' => $this->student_father_name,
            'studentMotherName' => $this->student_mother_name,
            'studentGuardianName' => $this->student_guardian_name,
            'studentSection' => $this->student_section,
            'studentType' => $this->student_type,
            'user' =>  [
                "id" => $this->user->id,
                "email" => $this->user->email,
                "emailVerifiedAt" => $this->user->email_verified_at,
                "role" => $this->user->role->role_name,
                'roleId' => $this->user->role_id,
                'profilePicture' => $this->user->profile_picture,
            ],
        ];
    }
}

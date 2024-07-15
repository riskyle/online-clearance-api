<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use App\Models\Student;
use App\Models\User;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        $user = auth()->user();

        return auth()->check() && $user->role_id === 1; //only super admin have authorize to update informations 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if ($method === "PUT") {

            return  [
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'lrn' => ['required', 'numeric', 'min_digits:12', 'max_digits:12', 'unique:' . Student::class],
                'studentFirstname' => ['required', 'string'],
                'studentMiddleName' => ['sometimes', 'required', 'string'],
                'studentLastname' => ['required', 'string'],
                'studentMobileNumber' => ['sometimes', 'string', 'min:11', 'max:11', 'unique:students,student_mobile_number'],
                'studentYearLevel' => ['required', 'numeric'],
                'studentSection' => ['required', 'string'],
                'studentAddress' => ['required', 'string'],
                'studentSex' => ['required', 'string'],
                'studentAge' => ['required', 'numeric'],
                'studentBirthdate' => ['required', 'string', 'date_format:Y-m-d'],
                'studentReligion' => ['required', 'string'],
                'studentCivilStatus' => ['required', 'string'],
                'studentFatherName' => ['required', 'string'],
                'studentMotherName' => ['required', 'string'],
                'studentGuardianName' => ['required', 'sometimes', 'string'],
                'studentType' => ['required', 'string', Rule::in(['jhs', 'shs'])]
            ];
        } else {

            return [
                'email' => ['sometimes', 'required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['sometimes', 'required', 'confirmed', Rules\Password::defaults()],
                'lrn' => ['sometimes', 'required', 'numeric', 'min_digits:12', 'max_digits:12', 'unique:' . Student::class],
                'studentFirstname' => ['sometimes', 'required', 'string'],
                'studentMiddlename' => ['sometimes', 'required', 'string'],
                'studentLastname' => ['sometimes', 'required', 'string'],
                'studentMobileNumber' => ['sometimes', 'required', 'string', 'min:11', 'max:11', 'unique:students,student_mobile_number'],
                'studentYearLevel' => ['sometimes', 'required', 'numeric'],
                'studentSection' => ['sometimes', 'required', 'string'],
                'studentAddress' => ['sometimes', 'required', 'string'],
                'studentSex' => ['sometimes', 'required', 'string'],
                'studentAge' => ['sometimes', 'required', 'numeric'],
                'studentBirthdate' => ['sometimes', 'required', 'string', 'date_format:Y-m-d'],
                'studentReligion' => ['sometimes', 'required', 'string'],
                'studentCivilStatus' => ['sometimes', 'required', 'string'],
                'studentFatherName' => ['sometimes', 'required', 'string'],
                'studentMotherName' => ['sometimes', 'required', 'string'],
                'studentGuardianName' => ['sometimes', 'required', 'sometimes', 'string'],
                'studentType' => ['sometimes', 'required', 'string', Rule::in(['jhs', 'shs'])]
            ];
        }
    }

    public function prepareForValidation()
    {
        $variables = $this->variables();

        $attr = [];

        foreach ($this->request as $vKey => $data) {

            if (array_key_exists($vKey, $variables)) {

                $attr[$variables[$vKey]] = $this->$vKey;
            }
        }

        $this->merge($attr);
    }

    protected function variables(): array
    {
        return [
            'passwordConfirmation' => 'password_confirmation',
            'studentFirstname' => 'student_firstname',
            'studentMiddlename' => 'student_middlename',
            'studentLastname' => 'student_lastname',
            'studentMobileNumber' => 'student_mobile_number',
            'studentYearLevel' => 'student_year_level',
            'studentSection' => 'student_section',
            'studentAddress' => 'student_address',
            'studentSex' => 'student_sex',
            'studentAge' => 'student_age',
            'studentBirthdate' => 'student_birthdate',
            'studentReligion' => 'student_religion',
            'studentCivilStatus' => 'student_civil_status',
            'studentFatherName' => 'student_father_name',
            'studentMotherName' => 'student_mother_name',
            'studentGuardianName' => 'student_guardian_name',
            'studentType' => 'student_type',
        ];
    }
}

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
        return true;
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
                'lrn' => ['required', 'numeric', 'unique:' . Student::class],
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
                'lrn' => ['sometimes', 'required', 'numeric', 'unique:' . Student::class],
                'studentFirstname' => ['sometimes', 'required', 'string'],
                'studentMiddleName' => ['sometimes', 'required', 'string'],
                'studentLastname' => ['sometimes', 'required', 'string'],
                'studentMobileNumber' => ['sometimes', 'sometimes', 'string', 'min:11', 'max:11', 'unique:students,student_mobile_number'],
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
        $varibles = $this->variables();

        foreach ($this->request as $vKey => $data) {

            if (array_key_exists($vKey, $varibles)) {

                $this->merge([$varibles[$vKey] => $this->$vKey]);
            }
        }
    }

    protected function variables(): array
    {
        return [
            'passwordConfirmation' => 'password_confirmation',
            'studentFirstname' => 'student_firstname',
            'studentMiddleName' => 'student_middlename',
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

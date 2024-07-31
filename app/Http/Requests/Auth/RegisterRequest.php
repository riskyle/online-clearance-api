<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use App\Models\Student;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'lrn' => ['required', 'numeric', 'min_digits:12', 'max_digits:12', 'unique:' . Student::class],
            'studentFirstname' => ['required', 'string'],
            'studentMiddleName' => ['sometimes', 'required', 'string'],
            'studentLastname' => ['required', 'string'],
            'studentSex' => ['required', 'string'],
            'studentYearLevel' => ['required', 'numeric'],
            'studentSection' => ['required', 'string'],
            'studentType' => ['required', 'string', Rule::in(['jhs', 'shs'])],
            'studentMobileNumber' => ['sometimes', 'required', 'string', 'min:11', 'max:11', 'unique:students,student_mobile_number'],
            'studentAddress' => ['sometimes', 'required', 'string'],
            'studentAge' => ['sometimes', 'required', 'numeric'],
            'studentBirthdate' => ['sometimes', 'required', 'string', 'date_format:Y-m-d'],
            'studentReligion' => ['sometimes', 'required', 'string'],
            'studentCivilStatus' => ['sometimes', 'required', 'string'],
            'studentFatherName' => ['sometimes', 'required', 'string'],
            'studentMotherName' => ['sometimes', 'required', 'string'],
            'studentGuardianName' => ['sometimes', 'required', 'sometimes', 'string'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'password_confirmation' => $this->passwordConfirmation,
            'student_firstname'  => $this->studentFirstname,
            'student_middleName'  => $this->studentMiddleName,
            'student_lastname'  => $this->studentLastname,
            'student_sex'  => $this->studentSex,
            'student_year_level'  => $this->studentYearLevel,
            'student_section'  => $this->studentSection,
            'student_type'  => $this->studentType,
            'student_mobile_number'  => $this->studentMobileNumber,
            'student_address'  => $this->studentAddress,
            'student_age'  => $this->studentAge,
            'student_birthdate'  => $this->studentBirthdate,
            'student_religion'  => $this->studentReligion,
            'student_civil_status'  => $this->studentCivilStatus,
            'student_father_name'  => $this->studentFatherName,
            'student_mother_name'  => $this->studentMotherName,
            'student_guardian_name'  => $this->studentGuardianName,
        ]);
    }

    public function messages(): array
    {
        return [
            //
        ];
    }
}

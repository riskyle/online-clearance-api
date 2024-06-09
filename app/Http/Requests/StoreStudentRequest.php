<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use App\Models\Student;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
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
        return [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'lrn' => ['required', 'numeric', 'unique:' . Student::class],
            'studentFirstname' => ['required', 'string'],
            'studentMiddleName' => ['sometimes', 'required', 'string'],
            'studentLastname' => ['required', 'string'],
            'studentMobileNumber' => ['sometimes', 'required', 'string', 'min:11', 'max:11', 'unique:students,student_mobile_number'],
            'studentYearLevel' => ['required', 'numeric'],
            'studentSection' => ['required', 'string'],
            'studentAddress' => ['sometimes', 'required', 'string'],
            'studentSex' => ['required', 'string'],
            'studentAge' => ['sometimes', 'required', 'numeric'],
            'studentBirthdate' => ['sometimes', 'required', 'string', 'date_format:Y-m-d'],
            'studentReligion' => ['sometimes', 'required', 'string'],
            'studentCivilStatus' => ['sometimes', 'required', 'string'],
            'studentFatherName' => ['sometimes', 'required', 'string'],
            'studentMotherName' => ['sometimes', 'required', 'string'],
            'studentGuardianName' => ['sometimes', 'required', 'sometimes', 'string'],
            'studentType' => ['required', 'string', Rule::in(['jhs', 'shs'])]
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'password_confirmation' => $this->passwordConfirmation,
            'student_lastname' => $this->studentLastname,
            'student_year_level' => $this->studentYearLevel,
            'student_section' => $this->studentSection,
            'student_mobile_number ' => $this->studentMobileNumber,
            'student_type' => $this->studentType,
        ]);
    }

    public function messages(): array
    {
        return [
            //
        ];
    }
}

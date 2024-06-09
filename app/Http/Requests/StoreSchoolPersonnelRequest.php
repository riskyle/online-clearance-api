<?php

namespace App\Http\Requests;

use App\Models\Student;
use App\Models\SchoolPersonnel;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class StoreSchoolPersonnelRequest extends FormRequest
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
            'roleId' => ['required', 'numeric', Rule::in([1, 2])],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'spFirstname' => ['required', 'string'],
            'spMiddlename' => ['sometimes', 'string', 'nullable'],
            'spLastname' => ['required', 'string'],
            'spAddress' => ['sometimes', 'string', 'nullable'],
            'spMobileNumber' => ['sometimes', 'string', 'nullable', 'min:11', 'max:11', 'unique:school_personnels,sp_mobile_number'],
            'spSex' => ['required', 'string', 'nullable'],
            'spAge' => ['sometimes', 'numeric', 'nullable'],
            'spBirthdate' => ['sometimes', 'string', 'nullable', 'date_format:Y-m-d'],
            'spReligion' => ['sometimes', 'string', 'nullable'],
            'spCivilStatus' => ['sometimes', 'string', 'nullable'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'role_id' => $this->roleId,
            'password_confirmation' => $this->passwordConfirmation,
            'sp_firstname' => $this->spFirstname,
            'sp_middlename' => $this->spMiddlename,
            'sp_lastname' => $this->spLastname,
            'sp_address' => $this->spAddress,
            'sp_mobile_number' => $this->spMobileNumber,
            'sp_sex' => $this->spSex,
            'sp_age' => $this->spAge,
            'sp_birthdate' => $this->spBirthdate,
            'sp_religion' => $this->spReligion,
            'sp_civil_status' => $this->spCivilStatus,
        ]);
    }

    public function messages(): array
    {
        return [
            'spFirstname.required' => 'The firstname field is required.',
            'spLastname.required' => 'The lastname field is required.',
            'spAddress.required' =>  'The address field is required.',
            'spSex.required' =>  'The sex field is required.',
            'spAge.required' =>  'The age field is required.',
            'spBirthdate.required' =>  'The birthdate field is required.',
            'spBirthdate.date_format' =>  'The birthdate field must match the format Year-Month-Date.',
            'spReligion.required' =>  'The religion field is required.',
            'spCivilStatus.required' =>  'The civil status field is required.',
            'spMobileNumber.unique' => 'The mobile number has already been taken.',
        ];
    }
}

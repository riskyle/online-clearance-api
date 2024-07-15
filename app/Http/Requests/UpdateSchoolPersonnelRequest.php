<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Validation\Rules;

class UpdateSchoolPersonnelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        $user = auth()->user();

        return auth()->check() && $user->role_id === 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if ($method === 'PUT') {
            return [
                'roleId' => ['required', 'numeric', Rule::in([1, 2])],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'spFirstname' => ['required', 'string'],
                'spMiddlename' => ['required', 'string', 'nullable'],
                'spLastname' => ['required', 'string'],
                'spAddress' => ['required', 'string', 'nullable'],
                'spMobileNumber' => ['string', 'nullable', 'min:11', 'max:11', 'unique:school_personnels,sp_mobile_number'],
                'spSex' => ['required', 'string', 'nullable'],
                'spAge' => ['required', 'numeric', 'nullable'],
                'spBirthdate' => ['required', 'string', 'nullable', 'date_format:Y-m-d'],
                'spReligion' => ['required', 'string', 'nullable'],
                'spCivilStatus' => ['required', 'string', 'nullable'],
            ];
        } else {
            return [
                'roleId' => ['sometimes', 'required', 'numeric', Rule::in([1, 2])],
                'email' => ['sometimes', 'required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['sometimes', 'required', 'confirmed', Rules\Password::defaults()],
                'spFirstname' => ['sometimes', 'required', 'string'],
                'spMiddlename' => ['sometimes', 'required', 'string', 'nullable'],
                'spLastname' => ['sometimes', 'required', 'string'],
                'spAddress' => ['sometimes', 'required', 'string', 'nullable'],
                'spMobileNumber' => ['sometimes', 'required', 'string', 'nullable', 'min:11', 'max:11', 'unique:school_personnels,sp_mobile_number'],
                'spSex' => ['sometimes', 'required', 'string', 'nullable'],
                'spAge' => ['sometimes', 'required', 'numeric', 'nullable'],
                'spBirthdate' => ['sometimes', 'required', 'string', 'nullable', 'date_format:Y-m-d'],
                'spReligion' => ['sometimes', 'required', 'string', 'nullable'],
                'spCivilStatus' => ['sometimes', 'required', 'string', 'nullable'],
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

    public function variables(): array
    {
        return [
            'roleId' => 'role_id',
            'spFirstname' => 'sp_firstname',
            'spMiddlename' => 'sp_middlename',
            'spLastname' => 'sp_lastname',
            'spAddress' => 'sp_address',
            'spMobileNumber' => 'sp_mobile_number',
            'spSex' => 'sp_sex',
            'spAge' => 'sp_age',
            'spBirthdate' => 'sp_birthdate',
            'spReligion' => 'sp_religion',
            'spCivilStatus' => 'sp_civil_status',
        ];
    }
}

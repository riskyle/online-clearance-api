<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        $user = $this->user();

        return auth()->check() && auth()->user()->id === $user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'profilePicture' => ['required', 'nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'profile_picture' => $this->profilePicture,
        ]);
    }
}

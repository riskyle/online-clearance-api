<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClearanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && in_array(auth()->user()->role_id, [1, 2]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'studentSection' => ['required', 'sometimes'],
            'quarterId' => ['required', Rule::in([1, 2, 3, 4])],
            'description' => ['required'],
            'task' => ['required'],
            'dueDate' => ['required', 'string', 'date_format:Y-m-d H:i:s'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'quarter_id' => $this->quarterId,
            'student_section' => $this->studentSection,
            'due_date' => $this->dueDate,
        ]);
    }
}

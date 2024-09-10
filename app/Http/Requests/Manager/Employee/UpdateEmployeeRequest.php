<?php

namespace App\Http\Requests\Manager\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'department_id' => "required|exists:departments,id",
            'first_name' => "required",
            'last_name' => "required",
            'email' => "required|unique:users,email,".$this->id,
            'phone' => "required|unique:users,phone,".$this->id,
            'salary' => "required|numeric|gt:0",
            "media" => "nullable|mimes:jpg,png,jpeg,svg",
        ];
    }
}

<?php

namespace App\Http\Requests\Manager\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'email' => "required|unique:users,email",
            'phone' => "required|unique:users,phone",
            'salary' => "required|numeric|gt:0",
            "media" => "required|mimes:jpg,png,jpeg,svg",
            'password' => "required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|confirmed",
        ];
    }
}

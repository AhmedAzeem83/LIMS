<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can("manage users");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->user ? $this->user->id : null;

        return [
            "name" => "required|string|max:255",
            "email" => [
                "required",
                "string",
                "email",
                "max:255",
                Rule::unique(User::class)->ignore($userId),
            ],
            "password" => [
                $this->isMethod("post") ? "required" : "nullable", // Required on create, optional on update
                "string",
                "min:8",
                "confirmed",
            ],
            "roles" => "required|array",
            "roles.*" => ["required", "string", Rule::exists("roles", "name")],
            "lab_id" => "nullable|exists:labs,id",
        ];
    }

    /**
     * Custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'roles.required' => 'At least one role must be selected.',
            'roles.*.exists' => 'One or more selected roles are invalid.',
            'lab_id.exists' => 'The selected lab does not exist.',
        ];
    }
}


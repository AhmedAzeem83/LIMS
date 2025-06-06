<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Authorization logic (e.g., check if user is admin)
        return $this->user()->can("manage labs");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:255",
            "location" => "required|string|max:255",
            "contact_person" => "nullable|string|max:255",
            "contact_email" => "nullable|email|max:255",
            "contact_phone" => "nullable|string|max:20",
        ];
    }
}


<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow creating/updating if user can manage tests
        // Specific logic for starting/completing/approving/rejecting is in controllers
        return $this->user()->can("manage tests");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            "sample_id" => ["required", "exists:samples,id"],
            "test_type" => ["required", "string", Rule::in(["density", "viscosity", "flash_point", "pour_point", "water_content", "sulfur_content", "composition", "other"])],
            "method" => "required|string|max:255", // ASTM Method
            "device_id" => "nullable|exists:devices,id",
            "assigned_to" => "nullable|exists:users,id",
            "status" => ["required", "string", Rule::in(["pending", "in_progress", "completed", "approved", "rejected"])],
            "notes" => "nullable|string",
            "results" => "nullable|json", // Validate results when completing
        ];

        // When creating, sample_id should not be disabled
        if ($this->isMethod("post")) {
            // No changes needed here for standard creation
        }

        // When updating, sample_id is usually fixed
        if ($this->isMethod("put") || $this->isMethod("patch")) {
            $rules["sample_id"] = ["sometimes", "required", "exists:samples,id"]; // Allow updating other fields without resending sample_id
        }

        return $rules;
    }
}


<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CalibrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can("calibrate devices");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "device_id" => ["required", "exists:devices,id"],
            "calibration_date" => "required|date",
            "next_due_date" => "required|date|after:calibration_date",
            "status" => ["required", "string", Rule::in(["pending", "passed", "failed"])],
            "certificate" => "nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120", // Max 5MB
            "notes" => "nullable|string",
        ];
    }
}


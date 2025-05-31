<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can("manage devices");
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
            "serial_number" => "required|string|max:255|unique:devices,serial_number," . ($this->device->id ?? "NULL") . ",id",
            "model" => "nullable|string|max:255",
            "manufacturer" => "nullable|string|max:255",
            "installation_date" => "nullable|date",
            "warranty_expiry_date" => "nullable|date|after_or_equal:installation_date",
            "status" => "required|in:active,inactive,maintenance,decommissioned",
            "lab_id" => "required|exists:labs,id",
        ];
    }
}


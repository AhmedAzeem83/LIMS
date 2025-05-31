<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChemicalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can("manage chemicals");
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
            "cas_number" => "nullable|string|max:50|unique:chemicals,cas_number," . ($this->chemical->id ?? "NULL") . ",id",
            "category" => "required|string|max:100",
            "quantity" => "required|numeric|min:0",
            "unit" => "required|string|max:20",
            "location" => "required|string|max:255",
            "expiry_date" => "nullable|date",
            "msds_file" => "nullable|file|mimes:pdf,doc,docx|max:5120", // Max 5MB
            "lab_id" => "required|exists:labs,id",
        ];
    }
}


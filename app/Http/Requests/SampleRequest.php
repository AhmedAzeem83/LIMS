<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SampleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow creating samples if user can manage samples
        // Allow updating if user can manage samples
        return $this->user()->can("manage samples");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "sample_id" => [
                "required",
                "string",
                "max:255",
                Rule::unique("samples", "sample_id")->ignore($this->sample->id ?? null),
            ],
            "client_name" => "required|string|max:255",
            "sample_type" => ["required", "string", Rule::in(["crude_oil", "natural_gas", "lpg", "glycol", "lubricating_oil", "water", "other"])],
            "received_date" => "required|date",
            "collection_date" => "required|date",
            "lab_id" => "required|exists:labs,id",
            "status" => ["required", "string", Rule::in(["received", "in_progress", "completed", "disposed"])],
            "notes" => "nullable|string",
        ];
    }
}


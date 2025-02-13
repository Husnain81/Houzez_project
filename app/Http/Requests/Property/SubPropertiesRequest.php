<?php

namespace App\Http\Requests\Property;

use Illuminate\Foundation\Http\FormRequest;

class SubPropertiesRequest extends FormRequest
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
            // 'subProperties' => 'required|array',
            // 'subProperties.*.title' => 'required|string|max:255',
            // 'subProperties.*.bedrooms' => 'nullable|integer|min:0',
            // 'subProperties.*.bathrooms' => 'nullable|integer|min:0',
            // 'subProperties.*.garages' => 'nullable|integer|min:0',
            // 'subProperties.*.garage_size' => 'nullable|string|max:255',
            // 'subProperties.*.area_size' => 'nullable|integer|min:0',
            // 'subProperties.*.size_prefix' => 'nullable|string|max:50',
            // 'subProperties.*.price' => 'nullable|numeric|min:0',
            // 'subProperties.*.price_label' => 'nullable|string|max:50',



            'subproperties' => 'required|array',
            'subproperties.*.id' => 'nullable|exists:sub_properties,id',
            'subproperties.*.title' => 'required|string|max:255',
            'subproperties.*.bedrooms' => 'required|numeric|min:1',
            'subproperties.*.bathrooms' => 'required|numeric|min:1',
            'subproperties.*.garages' => 'nullable|numeric|min:0',
            'subproperties.*.garage_size' => 'nullable|numeric|min:0',
            'subproperties.*.area_size' => 'nullable|integer|min:0',
            'subproperties.*.size_prefix' => 'nullable|string|max:50',
            'subproperties.*.price' => 'nullable|numeric|min:0',
            'subproperties.*.price_label' => 'nullable|string|max:50',
        ];
    }
}

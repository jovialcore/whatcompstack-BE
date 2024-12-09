<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyDataRequest extends FormRequest
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
            'name' => 'required',
            'about' => 'required',
            'url' => 'url|unique:companies,url',
            'ceo_name' => 'string|nullable',
            'cto_contact' => 'url|nullable',
            'cto_name' => 'string|nullable',
            'hr_name' => 'string|nullable',
            'hr_contact' => 'url |nullable',
            'logo' => 'required|mimes:png,jpeg,svg,webp',
            'source_slug' => 'nullable|string|unique:companies,source_slug'
        ];
    }
}

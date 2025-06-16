<?php

namespace App\Http\Requests;

class ApplicationUpdateRequest extends ApplicationCreateRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge (
            parent::rules(),
            [
                'cover' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:10000'],
            ]
        );
    }
}

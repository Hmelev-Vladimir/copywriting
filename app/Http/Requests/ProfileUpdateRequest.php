<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
            //
                'surname' => ['required', 'string', 'between:1,255'],
                'name' => ['required', 'string', 'between:1,255'],
                'phone' => ['required', 'regex:/^\\+?[1-9][0-9]{7,14}$/i'],
                'email' => ['required', 'email', 'between:1,255', Rule::unique('users')->ignore(auth('sanctum')->user()->id)],
                'login' => ['required', 'string', 'between:1,255', Rule::unique('users')->ignore(auth('sanctum')->user()->id)],
                'password' => ['required', 'string', 'between:6,255', 'confirmed']

        ];
    }
}

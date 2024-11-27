<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'surname' => ['required', 'string', 'between:1,255'],
            'name' => ['required', 'string', 'between:1,255'],
            'phone' => ['required', 'regex:/^\\+?[1-9][0-9]{7,14}$/i'],
            'email' => ['required', 'email', 'between:1,255', 'unique:users'],
            'login' => ['required', 'string', 'between:1,255', 'unique:users'],
            'password' => ['required', 'string', 'between:6,255', 'confirmed']
        ];
    }
}

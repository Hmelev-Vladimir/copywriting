<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePicRequest extends FormRequest
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
            'pic' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:10000'],
        ];
    }

    /**
     * Пользовательские сообщения об ошибках.
     */
    public function messages(): array
    {
        return [
            'pic.required' => '«Изображение профиля» — обязательное поле.',
            'pic.image' => '«Изображение профиля» должно быть изображением.',
            'pic.mimes' => '«Изображение профиля» должно быть в формате: .png, .jpg или .jpeg.',
            'pic.max' => '«Изображение профиля» не должно превышать 10 МБ.',
        ];
    }
}

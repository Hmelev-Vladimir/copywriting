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
            'phone' => ['required', 'regex:/^\+?[1-9][0-9]?(?:\s?[0-9]{3}){2}\s?[0-9]{2}\s?[0-9]{2}$/i'],
            'email' => ['required', 'email', 'between:1,255', 'unique:users'],
            'login' => ['required', 'string', 'between:1,255', 'unique:users'],
            'password' => ['required', 'string', 'between:6,255', 'confirmed'],
        ];
    }

    /**
     * Пользовательские сообщения об ошибках.
     */
    public function messages(): array
    {
        return [
            'surname.required' => '«Фамилия» — обязательное поле.',
            'surname.string' => '«Фамилия» должна быть строкой.',
            'surname.between' => 'Длина «Фамилии» должна быть от :min до :max символов.',

            'name.required' => '«Имя» — обязательное поле.',
            'name.string' => '«Имя» должно быть строкой.',
            'name.between' => 'Длина «Имени» должна быть от :min до :max символов.',

            'phone.required' => '«Телефон» — обязательное поле.',
            'phone.regex' => 'Неверный формат «Телефона». Пример: +7 937 110 17 01.',

            'email.required' => '«Email» — обязательное поле.',
            'email.email' => '«Email» должен быть действительным адресом.',
            'email.between' => 'Длина «Email» должна быть от :min до :max символов.',
            'email.unique' => 'Такой «Email» уже зарегистрирован.',

            'login.required' => '«Логин» — обязательное поле.',
            'login.string' => '«Логин» должен быть строкой.',
            'login.between' => 'Длина «Логина» должна быть от :min до :max символов.',
            'login.unique' => 'Такой «Логин» уже занят.',

            'password.required' => '«Пароль» — обязательное поле.',
            'password.string' => '«Пароль» должен быть строкой.',
            'password.between' => 'Длина «Пароля» должна быть от :min до :max символов.',
            'password.confirmed' => 'Пароли не совпадают.',
        ];
    }
}

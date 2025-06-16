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
            'surname' => ['required', 'string', 'between:1,255'],
            'name' => ['required', 'string', 'between:1,255'],
            'phone' => ['required', 'regex:/^\\+?[1-9][0-9]{7,14}$/i'],
            'email' => ['required', 'email', 'between:1,255', Rule::unique('users')->ignore($this->id)],
            'login' => ['required', 'string', 'between:1,255', Rule::unique('users')->ignore($this->id)],
            'password' => ['required', 'string', 'between:6,255', 'confirmed']
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
            'phone.regex' => 'Неверный формат «Телефона». Пример: +71234567890.',

            'email.required' => '«Email» — обязательное поле.',
            'email.email' => '«Email» должен быть действительным адресом.',
            'email.between' => 'Длина «Email» должна быть от :min до :max символов.',
            'email.unique' => 'Этот «Email» уже используется.',

            'login.required' => '«Логин» — обязательное поле.',
            'login.string' => '«Логин» должен быть строкой.',
            'login.between' => 'Длина «Логина» должна быть от :min до :max символов.',
            'login.unique' => 'Этот «Логин» уже занят.',

            'password.required' => '«Пароль» — обязательное поле.',
            'password.string' => '«Пароль» должен быть строкой.',
            'password.between' => 'Длина «Пароля» должна быть от :min до :max символов.',
            'password.confirmed' => 'Пароли не совпадают.',
        ];
    }
}

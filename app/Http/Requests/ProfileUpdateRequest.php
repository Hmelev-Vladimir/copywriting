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
            'surname.required' => "Необходимо ввести фамилию",
            'surname.string' => "Фамилия введена неправильно",
            'surname.min' => "Фамилия не должна быть меньшее 1 символа",
            'surname.max' => "Фамилия не должна превышать 255 символов",
            'name.required' => "Необходимо ввести имя",
            'name.string' => "Имя введена неправильно",
            'name.min' => "Имя не должно быть меньшее 1 символа",
            'name.max' => "Имя не должно превышать 255 символов",
            'email.required' => "Необходимо ввести email",
            'email.email' => "Email введен неправильно",
            'phone.required' => "Необходимо ввести телефон",
            'phone.string' => "Телефон введен неправильно",
            'phone.regex' => "Неверный формат телефона",
            'email.unique' => "Данный email уже используеться",
            'login.required' => "Необходимо ввести логин",
            'login.string' => "Логин введен неправильно",
            'login.unique' => "Данный логин уже используеться",
            'password.required' => "Необходимо ввести пароль",
            'password.string' => "Пароль введен неправильно",
            'password.min' => "Пароль не должн быть меньшее 6 символов",
            'password.max' => "Пароль не должна превышать 255 символов",
            'password.confirmed' => "Пароли не совпадают",
        ];
    }
}

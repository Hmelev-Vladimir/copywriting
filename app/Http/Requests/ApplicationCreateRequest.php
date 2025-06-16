<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Подготавливает форму для валидации.
     */
    protected function prepareForValidation(): void
    {
        if ($this->cover === 'null'){
            $this->merge([
              'cover' => null
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cover' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:10000'],
            'title' => ['required', 'string', 'max:255'],
            'theme' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:50000'],
            'price' => ['required', 'integer', 'min:0', 'max:2000000000'],
            'publicationDate' => ['required', 'date'],
        ];
    }

    /**
     * Пользовательские сообщения об ошибках.
     */
    public function messages(): array
    {
        return [
            'cover.required' => '«Обложка» — обязательное поле.',
            'cover.image' => '«Обложка» должна быть изображением.',
            'cover.mimes' => '«Обложка» должна быть в формате PNG, JPG или JPEG.',
            'cover.max' => '«Обложка» не должна превышать 10 МБ.',

            'title.required' => '«Название» — обязательное поле.',
            'title.string' => '«Название» должно быть строкой.',
            'title.max' => '«Название» не должно превышать 255 символов.',

            'theme.required' => '«Тема» — обязательное поле.',
            'theme.string' => '«Тема» должна быть строкой.',
            'theme.max' => '«Тема» не должна превышать 255 символов.',

            'description.required' => '«Описание» — обязательное поле.',
            'description.string' => '«Описание» должно быть строкой.',
            'description.max' => '«Описание» не должно превышать 50000 символов.',

            'price.required' => '«Цена» — обязательное поле.',
            'price.integer' => '«Цена» должна быть целым числом.',
            'price.min' => '«Цена» не может быть отрицательной.',
            'price.max' => '«Цена» не должна превышать 2 000 000 000.',

            'publicationDate.required' => '«Дата публикации» — обязательное поле.',
            'publicationDate.date' => '«Дата публикации» должна быть корректной датой.',
        ];
    }
}

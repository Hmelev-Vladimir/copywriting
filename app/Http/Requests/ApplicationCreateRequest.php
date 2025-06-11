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
        if($this->cover === 'null'){
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
            'cover' => ['required','image','max:10000'],
            'title' => ['required', 'string','max:255'],
            'theme' => ['required', 'string','max:255'],
            'description' => ['required','string', 'max:50000'],
            'price' => ['required','integer','min:0','max:2000000000'],
            'publicationDate' => ['required','date'],
        ];
    }

    /**
     * Пользовательские сообщения об ошибках.
     */
    public function messages(): array
    {
        return [
            'cover.required' => "Необходимо добавить изображение",
            'cover.image' => "Тип файла должно быть изображением",
            'cover.max' => "Файл превышает допустимый размер",
            'title.required' => "Необходимо ввести название",
            'title.string' => "Название введенно неверно",
            'title.max' => "название поста слишком длинное",
            'theme.required' => "Необходимо ввести тему",
            'theme.string' => "тема введена неверно",
            'theme.max' => "тема слишком длинная",
            'description.required' => "Необходимо ввести текст поста",
            'description.string' => "Текст введенн неверно",
            'description.max' => "текст поста слишком длинный",
            'price.required' => "Необходимо указать цену",
            'price.integer' => "Число лайков не правильно введено",
            'price.min' => "Цена не может быть равно или меньше нуля",
            'price.max' => "Цена превышает допустимый предел",
            'publicationDate.required' => "Необходимо указать дату",
            'publicationDate.date' => "Дата указана неправильно",
        ];
    }

}

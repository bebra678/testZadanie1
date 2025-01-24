<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product');
        return [
            'article' => ['required', 'string', 'min:3','max:255', Rule::unique('products')->ignore($productId), 'regex:/^[a-zA-Z0-9]+$/'],
            'name' => ['required', 'string', 'max:255', 'min:10'],
            'status' => ['required', 'in:available,unavailable'],
            'color' => ['required', 'string', 'max:255', 'min:2'],
            'size' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'article' => [
                'required' => 'Заполните поле',
                'max' => 'Максимально допустимое значение: 255',
                'unique' => 'Данный артикул уже существует',
                'regex' => 'Только латинские символы и цифры',
            ],
            'name' => [
                'required' => 'Заполните поле',
                'max' => 'Максимально допустимое значение: 255',
                'min' => 'Минимально допустимое значение: 10',
            ],
            'status' => [
                'required' => 'Заполните поле',
                'in' => 'Статус может быть только: available или unavailable',
            ],
            'color' => [
                'required' => 'Заполните поле',
                'max' => 'Максимально допустимое значение: 20',
                'min' => 'Минимально допустимое значение: 2',
            ],
            'size' => [
                'required' => 'Заполните поле',
                'max' => 'Максимально допустимое значение: 5',
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        return redirect()->back()->withErrors($validator->errors())->withInput();
    }
}

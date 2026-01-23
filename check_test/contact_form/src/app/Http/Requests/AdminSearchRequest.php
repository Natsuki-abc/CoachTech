<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Validation\Validator;

class AdminSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'text' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'numeric', 'between:1,3'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'date' => ['nullable', 'date', 'date_format:Y-m-d', 'before_or_equal:today'],
        ];
    }

    /**
     * 属性名
     *
     * @return Array $attributes
     */
    public function attributes()
    {
        $attributes = [
            'text' => 'お名前やメールアドレス',
            'gender' => '性別',
            'category_id' => 'お問い合わせの種類',
            'date' => '日付',
        ];

        return $attributes;
    }

    /**
     * Validation前のデータ処理
     *
     * @return Array
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'text'  => is_string($this->text) ? trim($this->text) : $this->text,
        ]);
    }
}

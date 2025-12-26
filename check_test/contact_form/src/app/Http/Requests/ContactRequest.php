<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Validation\Validator;

class ContactRequest extends FormRequest
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
            'last_name' => ['required', 'string', 'max:8'],
            'first_name' => ['required', 'string', 'max:8'],
            'gender' => ['required', 'numeric', 'between:1,3'],
            'email' => ['required', 'email', 'max:255'],
            'tel1' => ['required', 'numeric', 'digits_between:1,5'],
            'tel2' => ['required', 'numeric', 'digits_between:1,5'],
            'tel3' => ['required', 'numeric', 'digits_between:1,5'],
            'tel' => ['required', 'numeric', 'digits_between:10,11', 'phone:JP'],
            'address' => ['required', 'string', 'max:50'],
            'building' => ['string', 'max:30'],
            'category_id' => ['required', 'exists:categories,id'],
            'detail' => ['required', 'string', 'max:120'],
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
            'last_name' => 'お名前(姓)',
            'first_name' => 'お名前(名)',
            'gender' => '性別',
            'email' => 'メールアドレス',
            'tel' => '電話番号',
            'address' => '住所',
            'building' => '建物名',
            'category_id' => 'お問い合わせの種類',
            'detail' => 'お問い合わせ内容',
        ];

        return $attributes;
    }

    /**
     * カスタムエラーメッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tel1.digits_between' => '1項目あたり1～5桁の数字を入力してください。',
            'tel2.digits_between' => '1項目あたり1～5桁の数字を入力してください。',
            'tel3.digits_between' => '1項目あたり1～5桁の数字を入力してください。',
        ];
    }

    /**
     * Validation前のデータ処理
     *
     * @return Array
     */
    protected function prepareForValidation()
    {
        if (Route::is('confirm')) {
            $this->merge([
                'tel' => $this->tel1 . $this->tel2 . $this->tel3,
            ]);
        }
    }

    /**
     * Validation後に実行
     *
     * @return Array
     */
    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // tel1, tel2, tel3のエラーメッセージをtelにまとめる
            if (
                $validator->errors()->has('tel1') ||
                $validator->errors()->has('tel2') ||
                $validator->errors()->has('tel3')
            ) {
                $telErrors = array_merge(
                    $validator->errors()->get('tel1') ?? [],
                    $validator->errors()->get('tel2') ?? [],
                    $validator->errors()->get('tel3') ?? []
                );

                foreach ($telErrors as $error) {
                    $validator->errors()->add('tel', $error);
                }
            }
        });
    }
}

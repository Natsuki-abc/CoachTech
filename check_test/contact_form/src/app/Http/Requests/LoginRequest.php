<?php

namespace App\Http\Requests;

use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;

class LoginRequest extends FortifyLoginRequest
{
    public function rules()
    {
        $username = config('fortify.username', 'email');

        return [
            $username => ['required', 'string', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'このメールアドレスは登録されていません。',
        ];
    }
}

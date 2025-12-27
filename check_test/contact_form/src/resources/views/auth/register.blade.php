@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/auth/page.css') }}" />
@endsection

@section('content')

<div class="auth">
    <h1 class="page-title font-family__title">Register</h1>

    <div class="auth__inner">
        <form action="{{ route('register') }}" method="post" novalidate>
            @csrf
            <table class="auth__table">
                <tr class="auth__row">
                    <th class="auth__column">お名前</th>
                    <td class="auth__value">
                        <input type="text" name="name" placeholder="例：山田　太郎" value="{{ old('name') }}" />

                        @error('name')
                        <div class="error">
                            {{ $message }}
                        </div>
                        @enderror
                    </td>
                </tr>
                <tr class="auth__row">
                    <th class="auth__column">メールアドレス</th>
                    <td class="auth__value">
                        <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}" />

                        @error('email')
                        <div class="error">
                            {{ $message }}
                        </div>
                        @enderror
                    </td>
                </tr>
                <tr class="auth__row">
                    <th class="auth__column">パスワード</th>
                    <td class="auth__value">
                        <input type="password" name="password" placeholder="例：coachtech1106" value="{{ old('password') }}" />

                        @error('password')
                        <div class="error">
                            {{ $message }}
                        </div>
                        @enderror
                    </td>
                </tr>
                    </td>
                </tr>
            </table>

            <button class="btn btn--primary">登録</button>
        </form>
    </div>
</div>
@endsection

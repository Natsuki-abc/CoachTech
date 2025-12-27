@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/auth/page.css') }}" />
@endsection

@section('content')

<div class="auth">
    <h1 class="page-title font-family__title">Login</h1>

    <div class="auth__inner">
        <form action="{{ route('login') }}" method="post" novalidate>
            @csrf
            <table class="auth__table">
                <tr class="auth__row">
                    <th class="auth__column">メールアドレス</th>
                    <td class="auth__value">
                        <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}" />

                        @error('email')
                        <div class="auth__error">
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
                        <div class="auth__error">
                            {{ $message }}
                        </div>
                        @enderror
                    </td>
                </tr>
            </table>

            <button class="btn btn--primary">ログイン</button>
        </form>
    </div>
</div>
@endsection

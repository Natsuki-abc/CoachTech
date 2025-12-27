@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/index.css') }}" />
@endsection

@section('content')

<div class="contact-form">
    <h1 class="page-title font-family__title">Contact</h1>

    @if (session('error'))
    <div class="contact-form__error">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('confirm') }}" method="post" novalidate>
        @csrf
        <table class="contact-form__table">
            <tr class="contact-form__row">
                <th class="contact-form__column required">お名前</th>
                <td class="contact-form__value">
                    <div class="contact-form__value--row">
                        <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name', $data['last_name'])  }}" />
                        <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name', $data['first_name']) }}" />
                    </div>

                    @error('last_name')
                    <div class="contact-form__error">
                        {{ $message }}
                    </div>
                    @enderror
                    @error('first_name')
                    <div class="contact-form__error">
                        {{ $message }}
                    </div>
                    @enderror
                </td>
            </tr>
            <tr class="contact-form__row">
                <th class="contact-form__column required">性別</th>
                <td class="contact-form__value">
                    @foreach ($genders as $value => $label)
                    <label class="radio-label">
                        <input type="radio" name="gender" value="{{ $value }}" {{ old('gender', $data['gender']) == $value ? 'checked' : '' }} />
                        {{ $label }}
                    </label>
                    @endforeach

                    @error('gender')
                    <div class="contact-form__error">
                        {{ $message }}
                    </div>
                    @enderror
                </td>
            </tr>
            <tr class="contact-form__row">
                <th class="contact-form__column required">メールアドレス</th>
                <td class="contact-form__value">
                    <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email', $data['email']) }}" />

                    @error('email')
                    <div class="contact-form__error">
                        {{ $message }}
                    </div>
                    @enderror
                </td>
            </tr>
            <tr class="contact-form__row">
                <th class="contact-form__column required">電話番号</th>
                <td class="contact-form__value">
                    <div class="contact-form__value--row">
                        <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1', $data['tel1']) }}" /> -
                        <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2', $data['tel2']) }}" /> -
                        <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3', $data['tel3']) }}" />
                    </div>

                    @error('tel')
                    <div class="contact-form__error">
                        {{ $message }}
                    </div>
                    @enderror

                </td>
            </tr>
            <tr class="contact-form__row">
                <th class="contact-form__column required">住所</th>
                <td class="contact-form__value">
                    <input type="text" name="address" placeholder="例：東京都渋谷区道玄坂1丁目" value="{{ old('address', $data['address']) }}" />

                    @error('address')
                    <div class="contact-form__error">
                        {{ $message }}
                    </div>
                    @enderror
                </td>
            </tr>
            <tr class="contact-form__row">
                <th class="contact-form__column">建物名</th>
                <td class="contact-form__value">
                    <input type="text" name="building" placeholder="例：道玄坂マンション101" value="{{ old('building', $data['building']) }}" />

                    @error('building')
                    <div class="contact-form__error">
                        {{ $message }}
                    </div>
                    @enderror
                </td>
            </tr>
            <tr class="contact-form__row">
                <th class="contact-form__column required">お問い合わせの種類</th>
                <td class="contact-form__value">
                    <div class="select-wrapper">
                        <select name="category_id">
                            <option value="">選択してください</option>
                            @foreach ($categories as $id => $content)
                            <option value="{{ $id }}" {{ old('category_id', $data['category_id']) == $id ? 'selected' : ''}}>
                                {{ $content }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    @error('category_id')
                    <div class="contact-form__error">
                        {{ $message }}
                    </div>
                    @enderror
                </td>
            </tr>
            <tr class="contact-form__row">
                <th class="contact-form__column required">お問い合わせ内容</th>
                <td class="contact-form__value">
                    <textarea name="detail" rows="10" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $data['detail']) }}</textarea>

                    @error('detail')
                    <div class="contact-form__error">
                        {{ $message }}
                    </div>
                    @enderror
                </td>
            </tr>
        </table>

        <button class="btn btn--primary">確認画面</button>
    </form>
</div>
@endsection

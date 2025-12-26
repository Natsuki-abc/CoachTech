@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/index.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/confirm.css') }}" />
@endsection

@section('content')
<div class="contact-form">
    <h1 class="contact-form__title font-family__title">Confirm</h1>

    <form action="{{ route('store') }}" method="post">
    @csrf
        <table class="contact-form__table contact-form__table--confirm">
            <tr class="contact-form__row contact-form__row--confirm">
                <th class="contact-form__column contact-form__column--confirm">お名前</th>
                <td class="contact-form__value contact-form__value--confirm">
                    {{ $data['last_name'] }}　{{ $data['first_name'] }}
                </td>
            </tr>
            <tr class="contact-form__row contact-form__row--confirm">
                <th class="contact-form__column contact-form__column--confirm">性別</th>
                <td class="contact-form__value contact-form__value--confirm">
                    {{ $gender }}
                </td>
            </tr>
            <tr class="contact-form__row contact-form__row--confirm">
                <th class="contact-form__column contact-form__column--confirm">メールアドレス</th>
                <td class="contact-form__value contact-form__value--confirm">
                    {{ $data['email'] }}
                </td>
            </tr>
            <tr class="contact-form__row contact-form__row--confirm">
                <th class="contact-form__column contact-form__column--confirm">電話番号</th>
                <td class="contact-form__value contact-form__value--confirm">
                    {{ $data['tel1'] }} - {{ $data['tel2'] }} - {{ $data['tel3'] }}
                </td>
            </tr>
            <tr class="contact-form__row contact-form__row--confirm">
                <th class="contact-form__column contact-form__column--confirm">住所</th>
                <td class="contact-form__value contact-form__value--confirm">
                    {{ $data['address'] }}
                </td>
            </tr>
            <tr class="contact-form__row contact-form__row--confirm">
                <th class="contact-form__column contact-form__column--confirm">建物名</th>
                <td class="contact-form__value contact-form__value--confirm">
                    {{ $data['building'] }}
                </td>
            </tr>
            <tr class="contact-form__row contact-form__row--confirm">
                <th class="contact-form__column contact-form__column--confirm">お問い合わせの種類</th>
                <td class="contact-form__value contact-form__value--confirm">
                    {{ $category }}
                </td>
            </tr>
            <tr class="contact-form__row contact-form__row--confirm">
                <th class="contact-form__column contact-form__column--confirm">お問い合わせ内容</th>
                <td class="contact-form__value contact-form__value--confirm">
                    <p>{{ $data['detail'] }}</p>
                </td>
            </tr>
        </table>

        <div class="contact-form__btn">
            <button type="submit" class="btn btn--primary">送信</button>
            <a class="btn btn--light" href="{{ route('index') }}">修正</a>
        </div>
    </form>
</div>
@endsection

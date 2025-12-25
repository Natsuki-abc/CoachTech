@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/index.css') }}" />
@endsection

@section('content')
<div class="contact-form">
    <h1 class="contact-form__title font-family__title">Contact</h1>

    <form action="{{ route('confirm') }}" method="post">
    @csrf
        <table class="contact-form__table">
            <tr class="contact-form__row">
                <th class="contact-form__column required">お名前</th>
                <td class="contact-form__value contact-form__value--row">
                    <input type="text" name="last_name" placeholder="例：山田" />
                    <input type="text" name="first_name" placeholder="例：太郎" />
                </td>
            </tr>
            <tr class="contact-form__row">
                <th class="contact-form__column required">性別</th>
                <td class="contact-form__value">
                    <label class="radio-label"><input type="radio" name="gender" value="1" />男性</label>
                    <label class="radio-label"><input type="radio" name="gender" value="2" />女性</label>
                    <label class="radio-label"><input type="radio" name="gender" value="3" />その他</label>
                </td>
            </tr>
            <tr class="contact-form__row">
                <th class="contact-form__column required">メールアドレス</th>
                <td class="contact-form__value"><input type="email" name="email" placeholder="例：test@example.com" /></td>
            </tr>
            <tr class="contact-form__row">
                <th class="contact-form__column required">電話番号</th>
                <td class="contact-form__value contact-form__value--row">
                    <input type="tel" name="tel" placeholder="080" /> -
                    <input type="tel" name="tel" placeholder="1234" /> -
                    <input type="tel" name="tel" placeholder="5678" />
                </td>
            </tr>
            <tr class="contact-form__row">
                <th class="contact-form__column required">住所</th>
                <td class="contact-form__value"><input type="text" name="address" placeholder="例：東京都渋谷区道玄坂1丁目" /></td>
            </tr>
            <tr class="contact-form__row">
                <th class="contact-form__column">建物名</th>
                <td class="contact-form__value"><input type="text" name="building" placeholder="例：道玄坂マンション101" /></td>
            </tr>
            <tr class="contact-form__row">
                <th class="contact-form__column required">お問い合わせの種類</th>
                <td class="contact-form__value">
                    <div class="select-wrapper">
                        <select name="categry_id" id="">
                            <option value="">選択してください</option>
                            <option value="1">選択肢1</option>
                            <option value="2">選択肢2</option>
                            <option value="3">選択肢3</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr class="contact-form__row">
                <th class="contact-form__column required">お問い合わせ内容</th>
                <td class="contact-form__value">
                    <textarea name="detail" cols="" rows="10" placeholder="お問い合わせ内容をご記載ください"></textarea>
                </td>
            </tr>
        </table>

        <button class="btn btn--primary">確認画面</button>
    </form>
</div>
@endsection

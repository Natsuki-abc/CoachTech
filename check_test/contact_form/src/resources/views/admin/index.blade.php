@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}" />
@endsection

@section('content')

<div class="admin">
    <h1 class="page-title font-family__title">Admin</h1>

    @if (session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('confirm') }}" method="post" novalidate>
        @csrf
        <div class="admin__search">
            <div class="admin__search--inner">
                <input class="admin__search--input" type="text" name="text" placeholder="名前やメールアドレスを入力してください" value="{{ old('text') }}" />
                <div class="select-wrapper">
                    <select class="admin__search--input admin__search--select" name="gender">
                        <option value="">性別</option>
                        @foreach ($genders as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="select-wrapper">
                    <select class="admin__search--input admin__search--select" name="category_id">
                        <option value="">お問い合わせの種類</option>
                        @foreach ($categories as $id => $content)
                            <option value="{{ $id }}">{{ $content }}</option>
                        @endforeach
                    </select>
                </div>
                <input class="admin__search--input" type="date" name="date">
            </div>
            <div class="admin__search--btn">
                <button class="btn btn--primary" type="submit">検索</button>
                <button class="btn btn--reset">リセット</button>
            </div>
        </div>
    </form>

    <div class="admin__btn">
        <a href="{{ route('export') }}" class="btn btn--export">エクスポート</a>
        {{ $contacts->links('layouts.parts.pagination') }}
    </div>
    <div class="admin__table-wrapper">
        <table class="admin__table">
            <tr class="admin__row">
                <th class="admin__column">お名前</th>
                <th class="admin__column">性別</th>
                <th class="admin__column">メールアドレス</th>
                <th class="admin__column">お問い合わせの種類</th>
                <th class="admin__column"></th>
            </tr>
            @foreach ($contacts as $contact)
                <tr class="admin__row">
                    <td class="admin__value">
                        <div class="admin__value--row">
                            {{ $contact['last_name'] }}　{{ $contact['first_name'] }}
                        </div>
                    </td>
                    <td class="admin__value">
                        {{ $genders[$contact['gender']] }}
                    </td>
                    <td class="admin__value">
                        {{ $contact['email'] }}
                    </td>
                    <td class="admin__value">
                        {{ $categories[$contact['category_id']] }}
                    </td>
                    <td class="admin__value">
                        <button class="btn btn--secondary">詳細</button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

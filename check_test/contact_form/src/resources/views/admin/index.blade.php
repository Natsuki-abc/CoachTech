@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/admin/admin.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/admin/detail.css') }}" />
@endsection

@section('content')

<div class="admin">
    <h1 class="page-title font-family__title">Admin</h1>

    @if (session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('admin') }}" method="get" novalidate>
        <div class="admin__search">
            <div class="admin__search--inner">
                <input class="admin__search--input" type="text" name="text" placeholder="名前やメールアドレスを入力してください" value="{{ request('text') }}" />
                <div class="select-wrapper">
                    <select class="admin__search--input admin__search--select" name="gender">
                        <option value="">性別</option>
                        @foreach ($genders as $key => $label)
                            <option value="{{ $key }}" {{ request('gender') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="select-wrapper">
                    <select class="admin__search--input admin__search--select" name="category_id">
                        <option value="">お問い合わせの種類</option>
                        @foreach ($categories as $id => $content)
                            <option value="{{ $id }}" {{ request('category_id') == $id ? 'selected' : '' }}>{{ $content }}</option>
                        @endforeach
                    </select>
                </div>
                <input class="admin__search--input" type="date" name="created_at" value="{{ request('date') }}">
            </div>
            <div class="admin__search--btn">
                <button class="btn btn--primary" type="submit">検索</button>
                <a href="{{ route('admin') }}" class="btn btn--reset">リセット</a>
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
                        {{ $contact['last_name'] }}　{{ $contact['first_name'] }}
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
                        <button type="button" class="btn btn--secondary admin__btn--detail js-admin__btn--detail"
                            data-url="{{ route('detail', $contact['id']) }}">
                            詳細
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    {{-- 詳細モーダル --}}
    <div class="admin-modal__overlay js-admin-modal__overlay"></div>
    <div class="admin-modal js-admin-modal">
        あいうえお
        <div class="admin-modal__close-btn js-admin-modal__close-btn"></div>
        <div class="admin-modal__inner js-admin-modal__inner">
            {{-- ここに _detail_modal.blade.php が入る --}}
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('assets/js/admin/detail.js') }}"></script>
@endsection

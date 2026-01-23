<table class="admin-modal__table">
    <tr class="admin-modal__row">
        <th class="admin-modal__column">お名前</th>
        <td class="admin-modal__value">
            {{ $contact['last_name'] }}　{{ $contact['first_name'] }}
        </td>
    </tr>
    <tr class="admin-modal__row">
        <th class="admin-modal__column">性別</th>
        <td class="admin-modal__value">
            {{ $genders[$contact['gender']] }}
        </td>
    </tr>
    <tr class="admin-modal__row">
        <th class="admin-modal__column">メールアドレス</th>
        <td class="admin-modal__value">
            {{ $contact['email'] }}
        </td>
    </tr>
    <tr class="admin-modal__row">
        <th class="admin-modal__column">電話番号</th>
        <td class="admin-modal__value">
            {{ $contact['tel'] }}
        </td>
    </tr>
    <tr class="admin-modal__row">
        <th class="admin-modal__column">住所</th>
        <td class="admin-modal__value">
            {{ $contact['address'] }}
        </td>
    </tr>
    <tr class="admin-modal__row">
        <th class="admin-modal__column">建物名</th>
        <td class="admin-modal__value">
            {{ $contact['building'] }}
        </td>
    </tr>
    <tr class="admin-modal__row">
        <th class="admin-modal__column">お問い合わせの種類</th>
        <td class="admin-modal__value">
            {{ $contact->category['content'] }}
        </td>
    </tr>
    <tr class="admin-modal__row">
        <th class="admin-modal__column">お問い合わせ内容</th>
        <td class="admin-modal__value">
            {{ $contact['detail'] }}
        </td>
    </tr>
</table>

<form action="{{ route('delete') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $contact['id'] }}">
    <button class="btn btn--delete">削除</button>
</form>

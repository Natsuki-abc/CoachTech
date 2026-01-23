<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>FashionablyLate</title>

    <link rel="stylesheet" href="{{ asset('assets/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/thanks.css') }}" />
</head>

<body>
    <main class="main">

        <h1 class="page-title font-family__title contact-thanks__overlay">Thank you</h1>

        <div class="contact-thanks">
            <h2 class="contact-thanks__heading">お問い合わせ<br class="sp_only">ありがとうございました</h2>
            <a class="btn btn--primary font-family__title contact-thanks__btn" href="{{ route('index') }}">HOME</a>
        </div>
    </main>
</body>

</html>

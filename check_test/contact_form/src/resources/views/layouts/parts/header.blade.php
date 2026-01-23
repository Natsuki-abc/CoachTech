<header class="header">
    <div class="header__inner font-family__title">
        <a class="header__logo" href="{{ route('index') }}">
            FashionablyLate
        </a>

        @if (Route::is('register'))
            <a class="btn btn--secondary header__btn" href="{{ route('login') }}">
                login
            </a>
        @elseif (Route::is('login'))
            <a class="btn btn--secondary header__btn" href="{{ route('register') }}">
                register
            </a>
        @elseif (Auth::check())
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="btn btn--secondary header__btn">logout</button>
            </form>
        @endif
    </div>
</header>

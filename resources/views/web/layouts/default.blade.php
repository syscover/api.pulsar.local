<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Titulo de la página')</title>

    <!-- Laravel Mix -->
    <link rel="stylesheet" href="{{ mix('css/all.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @yield('head')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="#">DH2</a>

        <div class="collapse navbar-collapse" id="mainMenu">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item {{ active_route(['web.home', 'web.home-' . user_lang()], 'active') }}">
                    <a class="nav-link" href="{{ route('web.home-' . user_lang()) }}">{{ trans('core::common.home') }}</a>
                </li>
                <li class="nav-item {{ active_route(['web.blog-' . user_lang(), 'article-' . user_lang()], 'active') }}">
                    <a class="nav-link" href="{{ route('web.blog-' . user_lang()) }}">{{ trans_choice('core::common.blog', 1) }}</a>
                </li>
                <li class="nav-item {{ active_route('web.products-' . user_lang(), 'active') }}">
                    <a class="nav-link" href="{{ route('web.products-' . user_lang()) }}">{{ trans_choice('core::common.product', 2) }}</a>
                </li>
                <li class="nav-item {{ active_route('web.shopping_cart-' . user_lang(), 'active') }}">
                    <a class="nav-link" href="{{ route('web.shopping_cart-' . user_lang()) }}">{{ trans('core::common.shopping_cart') }}</a>
                </li>
                <li class="nav-item dropdown {{ active_route(['web.account-' . user_lang(), 'web.get_login-' . user_lang()], 'active') }}">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ trans('core::common.my_account') }}
                    </a>
                    @if(auth('crm')->check())
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('web.account-' . user_lang()) }}">{{ trans('core::common.my_account') }}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('web.logout-' . user_lang()) }}">{{ trans('core::common.logout') }}</a>
                        </div>
                    @else
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('web.get_login-' . user_lang()) }}">{{ trans('core::common.login') }}</a>
                        </div>
                    @endif
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ trans_choice('core::common.language', 1) }}
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item @if(user_lang() === 'es') active @endif" href="{{ get_lang_route('es') }}">{{ trans('core::common.spanish') }}</a>
                        <a class="dropdown-item @if(user_lang() === 'en') active @endif" href="{{ get_lang_route('en') }}">{{ trans('core::common.english') }}</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="{{ mix('js/all.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
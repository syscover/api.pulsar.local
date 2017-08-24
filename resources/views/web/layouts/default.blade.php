<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Titulo de la página')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/froala/css/froala_style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @yield('head')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Pulsar</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item {{ active_route(['home', 'home-' . user_lang()], 'active') }}">
                    <a class="nav-link" href="{{ route('home-' . user_lang()) }}">{{ trans('common.home') }}</a>
                </li>
                <li class="nav-item {{ active_route(['blog-' . user_lang(), 'article-' . user_lang()], 'active') }}">
                    <a class="nav-link" href="{{ route('blog-' . user_lang()) }}">{{ trans_choice('common.blog', 1) }}</a>
                </li>
                <li class="nav-item {{ active_route('getProducts-' . user_lang(), 'active') }}">
                    <a class="nav-link" href="{{ route('getProducts-' . user_lang()) }}">{{ trans_choice('common.product', 2) }}</a>
                </li>
                <li class="nav-item {{ active_route('getShoppingCart-' . user_lang(), 'active') }}">
                    <a class="nav-link" href="{{ route('getShoppingCart-' . user_lang()) }}">{{ trans('common.shopping_cart') }}</a>
                </li>
                <li class="nav-item dropdown {{ active_route(['account-' . user_lang(), 'getLogin-' . user_lang()], 'active') }}">
                    <a class="nav-link dropdown-toggle pointer" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                        {{ trans('common.my_account') }}
                    </a>
                    @if(auth('crm')->check())
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('account-' . user_lang()) }}">{{ trans('common.my_account') }}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout-' . user_lang()) }}">{{ trans('common.logout') }}</a>
                        </div>
                    @else
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('getLogin-' . user_lang()) }}">{{ trans('common.login') }}</a>
                        </div>
                    @endif
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle pointer" id="languageMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ trans_choice('common.language', 1) }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="languageMenu">
                        <a class="dropdown-item" href="{{ get_lang_route('es') }}">{{ trans('common.spanish') }}</a>
                        <a class="dropdown-item" href="{{ get_lang_route('en') }}">{{ trans('common.english') }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('vendor/popper/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    @yield('scripts')

</body>
</html>
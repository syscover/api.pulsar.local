<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Titulo de la página')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

    @yield('head')
</head>
<body>

<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Pulsar</a>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
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
                    <a class="dropdown-item @if(user_lang() == 'es') active @endif" href="{{ get_lang_route('es') }}">{{ trans('common.spanish') }}</a>
                    <a class="dropdown-item @if(user_lang() == 'en') active @endif" href="{{ get_lang_route('en') }}">{{ trans('common.english') }}</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>

@yield('scripts')
</body>
</html>
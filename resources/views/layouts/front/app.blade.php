<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) Google Anytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Data());

        gtag('config', '{{ env('GOOGLE_ANALYTICS') }}');
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <title>Laracom</title>
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"></script>
    <script src="{{ asset('https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('favicons/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicons/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    @yield('css')
    <meta propety="og:url" content="{{ request()->url }}"/>
    @yield('og')
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js') }}"></script>

</head>
<body>
<noscript>
    <!-- Sessão que só ira funcinar se o JS da página estiver desativado -->
    <p class="alert alert-danger">
        You need to turn your javascript. Some functionality will not work if this is disabled.
        <a href="http://www.anable-javascript.com/" target="_blank">Read more</a>
    </p>
</noscript>

<section>
    <div class="hidden-xs">
        <div class="container">
            <div class="clearfix"></div>
            <div class="pull-right">
<!-- Prática de Navbar -->
                <ul class="nav nav-bar">
                    <!-- Checar se usuário está logado -->
                    @if(auth()->check())
                        <li><a href=" {{ route('account', ['tab' => 'tabname']]) }} "><i class="fa fa-home"></i>My Account</a></li>
                        <li><a href=" {{ route('logout') }} "><i class="fa-sig-out"></i>Logout</a></li>
                    @else 
                        <li><a href="{{ route('login') }}"><i class="fa-sigin"></i>Login</a></li>
                        <li><a href="{{ route('register') }}"><i class="fa-sing-register"></i>Register</a></li>
                    @endif 
                    <!-- Link do para entrar no carrinho. Ele terá uma id e uma classe. Dentro desse
                    li, terá um link, que será um redirect para view cart. Dentro do link, terá o icone de cart,
                    e terá  a contragem de coisas no carrinho em um span. Você usa a varia´vel cartCout para trazer. -->
                    <li id="cart" class="cart">
                        <a href="{{ route('view.cart') }}">
                            <i class="fa-cart"></i>
                            <span>{{ $cartCout }}</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <header id="header-section">
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get gouped for mobile display -->
                <div>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="coppapse" data-target="$b5-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navtion</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}></a>
                </div>
                <div class="col-md-10">
                    @include('layouts.front.header-cart')
                </div>
            </div>
        </nav>
    </header>
</section>
@yield('content')

@include('layouts.front.footer')

<script src="{{ asset('js/front.min.js') }}"></script>
<script src=" {{ asset('js/custom.js') }} "></script>
@yild('js')
    
</body>
</html>
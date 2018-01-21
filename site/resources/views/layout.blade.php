<!doctype html> <!-- HTML5 -->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>

        <meta name="description" content="TODO: site description, less than 150 characters">

        <link rel="icon" type="image/png" href="/favicon.png">

        <!-- Custom Fonts -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="{{ elixir('css/site.css') }}" rel="stylesheet">
        @yield('styles')

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body id="top">
        <nav class="navbar is-dark is-fixed-top">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-item has-text-weight-bold" href="/">
                        {{ config('site.name') }}
                    </a>
                    <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <div id="navbarExampleTransparentExample" class="navbar-menu">
                    <div class="navbar-start">
                        <a class="navbar-item page-scroll" href="#top">
                            Home
                        </a>
                        <a class="navbar-item page-scroll" href="#section2">
                            Section 2
                        </a>
                    </div>
                    <div class="navbar-end">
                        <div class="navbar-item">
                            <a class="button is-primary" href="#">
                                <i class="fa fa-ravelry"></i>&nbsp;Action
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        @yield('body')

        <footer class="footer">
            <div class="container">
                <div class="content has-text-centered">
                    <p>Copyright &copy; {{ config('site.name') }}. {{ date('Y') }}</p>
                </div>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="{{ elixir('js/site.js') }}"></script>
        @include('partials.analytics')
        @yield('scripts')
    </body>
</html>
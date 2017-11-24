<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <strong>{{ config('app.name', 'Laravel') }}</strong>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}"><strong>Login</strong></a></li>
                            <li><a href="{{ route('register') }}"><strong>Register</strong></a></li>
                        @else
                            @switch(Auth::user()->role)
                                @case(1)
                                    <li><a href="{{ url('client/new_ticket') }}"><strong>New Ticket</strong></a></li>
                                    <li><a href="{{ url('client/my_tickets') }}"><strong>My Tickets</strong></a></li>
                                    <li><a href="{{ url('client/my_invoices') }}"><strong>Invoices</strong></a></li>
                                    @break
                                @case(2)
                                    ;<li><a href="{{ url('technical/tickets') }}"><strong>Tickets</strong></a></li>
                                    @break
                                @case(3)
                                    <li><a href="{{ url('billing/new_invoice') }}"><strong>New Invoice</strong></a></li>
                                    <li><a href="{{ url('billing/invoices') }}"><strong>Invoices</strong></a></li>
                                    @break
                                @case(4)
                                    <li><a href=""><strong>Leads</strong></a></li>
                                    @break
                                @case(5)
                                    <li><a href="{{ route('roles') }}"><strong>Roles</strong></a></li>
                                    @break
                                @default
                                    <li <a href=""></a>>Nothing</li>
                            @endswitch
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/ajax-form.js') }}"></script>
</body>
</html>

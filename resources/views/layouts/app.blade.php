<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @auth
            <nav class="admin-header">
                <div class="container ">
                    <div class="d-flex align-items-center justify-content-center py-5 admin-header__logo">
                        <img src="{{ asset('svg/fixandfree.salon_logo_horizontal.svg') }}"
                            alt="Fix and Free Salon">
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-md-3">
                            <span class="d-flex align-items-baseline">
                            <img src="{{ asset('svg/icons/store.svg') }}" alt="Icon Total Branch" class="mr-2 mb-3">
                                Total Active Branch: &nbsp; <b> 88 </b>
                            </span>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-unstyled d-flex justify-content-end p-0 m-0">
                                <li>
                                    <a href="{{ route( 'profile' ) }}">
                                        {{ Auth::user()->first_name .' '.Auth::user()->last_name }}
                                        <img src="{{ asset( 'svg/icons/profile.svg' ) }}" alt="Icon Profile" class="ml-2">
                                    </a>
                                </li>
                                <li class="ml-5 ">

                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        <img src="{{ asset( 'svg/icons/logout.svg' ) }}" alt="Logout Image">
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        @endauth

        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>

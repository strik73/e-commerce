<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.10.5/autoNumeric.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('css/dataTable.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>

<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .navbar-brand {
        font-weight: 900;
        font-size: 24px;
        color: rgb(52, 120, 255);
        text-decoration: underline 2px rgb(43, 99, 209);
        text-underline-offset: 3px;
    }

    #app {
        flex: 1;
    }

    #footer {
        height: 3.5rem;
        position: relative;
        bottom: 0;
        width: 100%;
    }

    .avatar {
        border: 0.5px solid rgb(201, 221, 255);
        padding: 4px 10px;
        border-radius: 7px;
        background-color: rgb(134, 178, 255);
        /* box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.178); */
        color: rgb(255, 251, 246);
        font-weight: 500;
    }
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    TokopeDio
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a type="button" class="btn btn-sm px-3 btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a type="button" class="btn btn-sm btn-outline-primary px-3 ms-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link d-flex align-items-center dropdown-toggle"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    <div class="avatar justify-content-center align-middle text-center mx-2">
                                        @php
                                            echo strtoupper(substr(Auth::user()->name, 0, 2));
                                        @endphp </div>
                                    <span>{{ Auth::user()->name }}</span>
                                </a>


                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (auth()->user()->can('VIEW ADMIN'))
                                        <a class="dropdown-item" href="{{ route('admin.home') }}">
                                            Admin Dashboard
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('profile.index', auth()->user()->id) }}">
                                        Profile
                                    </a>

                                    @if (auth()->user()->can('VIEW MERCHANT'))
                                        <a class="dropdown-item" href="{{ route('merchant.dashboard') }}">
                                            Merchant Page
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <footer id="footer" class="bg-light shadow shadow-md border">
        <div class="float-end pt-3 pe-4 flex">
            <p>All right reserved. Copyright &copy; {{ date('Y') }}</p>
        </div>
    </footer>
</body>


</html>

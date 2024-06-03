<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
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

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        #page-container {
            position: relative;
        }


        #content-wrap {
            padding-bottom: 2.5rem;
            padding-left: 19rem;
            padding-top: 1rem;
            padding-right: 2rem;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #footer {
            height: 3.5rem;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .nav-link:hover {
            background-color: #ffffff38;
        }

        .nav-item .nav-link.active {
            background-color: #0346ab !important;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="page-container">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark"
            style="width: 280px; height: 100vh; position: fixed; z-index: 100;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="ms-4 fs-4">Admin Dashboard</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.homre') }}"
                        class="nav-link text-white @if (request()->routeIs('admin.home')) active @endif" aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            style="translate: -1px -4px" stroke-linejoin="round" class="ms-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                        </svg>
                        Home
                    </a>
                </li>
                <hr />
                <li class="nav-item">
                    <a href="{{ route('user.index') }}"
                        class="nav-link text-white @if (request()->routeIs('user.index')) active @endif" aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="ms-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                        </svg>
                        Master User
                    </a>
                </li>
                <hr />
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            style="translate: -1px -2px" stroke-linejoin="round" class="ms-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                            <path d="M12 12l8 -4.5" />
                            <path d="M12 12l0 9" />
                            <path d="M12 12l-8 -4.5" />
                        </svg>
                        Master
                    </a>
                </li>
                <li class="ms-3 nav-item">
                    <a href="{{ route('category.index') }}"
                        class="nav-link text-white ms-4 @if (request()->routeIs('category.index')) active @endif">
                        Category
                    </a>
                </li>
                <li class="ms-3 nav-item">
                    <a href="{{ route('items.index') }}"
                        class="nav-link text-white ms-4 @if (request()->routeIs('items.index')) active @endif">
                        Items
                    </a>
                </li>
                <hr />
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="ms-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M13 5h8" />
                            <path d="M13 9h5" />
                            <path d="M13 15h8" />
                            <path d="M13 19h5" />
                            <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        </svg>
                        Transactions
                    </a>
                </li>
                <li class="ms-3 nav-item">
                    <a href="{{ route('transaction.index') }}"
                        class="nav-link text-white ms-4 @if (request()->routeIs('transaction.index')) active @endif">
                        Transaction List
                    </a>
                </li>
                <li class="ms-3 nav-item">
                    <a href="{{ route('payment.index') }}"
                        class="nav-link text-white ms-4 @if (request()->routeIs('payment.index')) active @endif">
                        Payment History
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="z-index: 50">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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

    <div id="content-wrap">
        @yield('content')
    </div>

    <footer id="footer" class="bg-light shadow shadow-md border">
        <div class="float-end pt-3 pe-4 flex">
            <p>All right reserved. Copyright &copy; {{ date('Y') }}</p>
        </div>
    </footer>

</body>



</html>

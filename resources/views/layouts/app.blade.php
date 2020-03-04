<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Coaster') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/toastr.min.js') }}" defer></script>
    <script src="{{ asset('js/sweetalert.min.js') }}" defer></script>
     <script src="{{ asset('js/loader.js') }}" defer></script> 

    <!-- Fonts -->
    <link href="{{ asset('css/font-family.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert.min.css.map') }}" rel="stylesheet">
    <style>
        body{
            background: white;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
    <div id="app" class="pb-5">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <div class="container">
                 {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-phone"></i> Loc. 3113 | <i class="fas fa-phone"></i> Loc. 3112
                </a>  --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    
                    
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link disabled" href="{{ url('/') }}" style="color: black;">
                                <i class="fas fa-phone"></i> Loc. 3113 | <i class="fas fa-phone"></i> Loc. 3112
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" style="color: black;">
                                PMC Coaster Booking System
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" style="color: black;">
                                |
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="PMC COASTER BOOKING SYSTEM - MANUAL.pdf" target="_blank">
                                System manual
                            </a>
                        </li>
                        @else
                        <syncdavao></syncdavao>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" style="color: black;">
                                |
                            </a>
                        </li>
                        <syncagusan></syncagusan>  
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm sticky-top pt-0 pb-0 border" @guest  hidden @endguest>
            <div class="container">
                 <a class="navbar-brand text-danger" href="{{ url('/') }}">
                    PMC Booking System
                </a> 
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    
                    @auth
                    {{-- <ul class="navbar-nav mr-auto">

                       
                         <li class="nav-item">
                            <a href="{{ route('seat.index') }}" class="nav-link">Seat Status</a>
                        </li> 
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Seat Status <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('seat.monday') }}">
                                    Monday
                                </a>
                                <a class="dropdown-item" href="{{ route('seat.saturday') }}">
                                    Saturday
                                </a>
                                <a class="dropdown-item" href="{{ route('seat.summary') }}">
                                    View Summary
                                </a>

                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('booking.index') }}" class="nav-link">Bookings</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('schedule.index') }}" class="nav-link">Schedule</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employee.index') }}" class="nav-link">Employees</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Employee <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('employee.index') }}">
                                    View Employees
                                </a>
                                <a class="dropdown-item" href="{{ route('status.priority') }}">
                                    Employee Priority
                                </a>
                                <a class="dropdown-item" href="{{ route('status.blacklist') }}">
                                    Employee Blacklist
                                </a>

                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('destination.index') }}" class="nav-link">Destination</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('trip.index') }}" class="nav-link">Trip Schedule</a>
                        </li> 
                        <li class="nav-item">
                            <a href="{{ route('employee.index') }}" class="nav-link">Destination</a>
                        </li> 
                         <li class="nav-item">
                            <a href="{{ route('status.priority') }}" class="nav-link">Priority</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('status.blacklist') }}" class="nav-link">Blacklist</a>
                        </li>
                    </ul> --}}
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto nav-pills">
                        <!-- Authentication Links -->
                        @guest
                             <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Seat Status <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item {{ request()->is('seat_status/monday') ? 'active' : '' }}" href="{{ route('seat.monday') }}">
                                        Monday
                                    </a>
                                    <a class="dropdown-item {{ request()->is('seat_status/saturday') ? 'active' : '' }}" href="{{ route('seat.saturday') }}">
                                        Saturday
                                    </a>
                                    {{-- <a class="dropdown-item" href="{{ route('seat.summary') }}">
                                        View Summary
                                    </a>  --}}

                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('schedule.index') }}" class="nav-link {{ request()->is('schedule') ? 'active text-white' : '' }}">Schedule</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('destination.index') }}" class="nav-link {{ request()->is('destination') ? 'active text-white' : '' }}">Destination</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('employee.index') }}" class="nav-link {{ request()->is('employees') ? 'active text-white' : '' }}">Employees</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('status.priority') }}" class="nav-link {{ request()->is('employees/priority') ? 'active text-white' : '' }}">Priority</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('status.blacklist') }}" class="nav-link {{ request()->is('employees/blacklist') ? 'active text-white' : '' }}">Blacklist</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Reports <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item {{ request()->is('feedback') ? 'active text-white' : '' }}" href="{{ route('feedback.index') }}">
                                        Employee's Feedback
                                    </a>
                                    <a class="dropdown-item {{ request()->is('schedule') ? 'active text-white' : '' }}" href="#">
                                        Booking Summary
                                    </a>
                                    <a class="dropdown-item {{ request()->is('bookings-history') ? 'active text-white' : '' }}" href="{{ route('seat_logs.index') }}">
                                        Booking History
                                    </a>
                                    <a class="dropdown-item {{ request()->is('schedule') ? 'active text-white' : '' }}" href="#">
                                        Booking per Employee
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('change_password') }}">Change Password</a>
                                    @if (Auth::user()->name == 'Administrator')
                                        <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        <a class="dropdown-item" href="{{ route('user.index') }}">{{ __('Users') }}</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
    <footer class="bg-light p-3">
        <div class="container d-flex justify-content-between">
            <div>
                {{ date('Y') }} © PMC-ICT. ALL Rights Reserved
            </div>
            <div>
                <label style="color:#ccc; margin-bottom: 0px;">DL.S.O</label>
            </div>
        </div>
    </footer>     
</body>
</html>

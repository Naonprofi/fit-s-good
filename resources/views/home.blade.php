@extends('layouts.app')

@section('navbar')
    <nav class="navbar navbar-expand-lg navbar-light  shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="" id="navbarSupportedContent">

                <div class="left-nav">
                    <div class="navbar-nav me-auto">
                        <div class="welcome-text">
                            <h1>Welcome to Fit's Good!</h1>
                            <p>Succesful login! In the Actions menu, you can choose to see our Menu, make Reservations or
                                check your Membership.</p>
                        </div>
                    </div>
                </div>



                <ul class="navbar-nav ms-auto right-nav">

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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('menu') }}">Menu</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('contacts') }}">Contact Us</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    {{ __('Profile') }}
                                </a>
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"> Actions

                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('menu') }}">Menu</a></li>
                                <li><a class="dropdown-item" href="{{ route('reservations') }}">Reservations</a></li>
                                <li><a class="dropdown-item" href="{{ route('membership') }}">Membership</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('contacts') }}">Contacts</a></li>
                            </ul>
                        </li>

                    @endguest
                </ul>
            </div>
        </div>
    </nav>
@endsection

@section('content')

    <head>
        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/welcome.css'])
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="section">
            <div class="container">
                <div class="row d-flex align-items-center">

                    <div class="col-lg-2 d-flex flex-column">
                        <h1 class="hero-title">healthy, delicious and fit in one place</h1>
                        <a  href="{{ route('menu') }}" class="menu-btn">Check our MENU →</a>
                    </div>

                    <div class="col-lg-5 d-flex justify-content-center">
                        <div class="food-card">
                            <img src="{{ asset('images/fooldal1.png') }}" class="img-fluid w-75 rounded-4"
                                alt="Healthy food plate">
                            <span class="food-text">Broccoli with sour cream and cheese, oven-baked (V)</span>
                        </div>
                    </div>

                    <div class="col-lg-5 d-flex justify-content-center">
                        <div class="food-card">
                            <img src="{{ asset('images/fooldal2.png') }}" class="img-fluid w-75 rounded-4"
                                alt="Charcuterie board">
                            <span class="food-text">Grilled chicken with bulgur, asparagus and
                                broccoli</span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container story mt-5">

                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="story-title">THE STORY BEHIND EVERY MEAL</h2>
                    </div>
                </div>

                <div class="row align-items-center mt-4">


                    <div class="col-12 col-lg-6 story-img text-center">
                        <img src="{{ asset('images/fooldal3.png') }}" alt="Story image">
                    </div>


                    <div class="col-12 col-lg-6 story-text">
                        <p>Fit’s Good is a contemporary restaurant founded by food enthusiasts who believed that healthy
                            cuisine can be both elegant and genuinely enjoyable.</p>

                        <hr class="story-divider">

                        <p>Their mission is simple: to create dishes from fresh, high-quality ingredients that are not only
                            nourishing but also offer a memorable dining experience. Over time, Fit’s Good has become a
                            refined, slightly upscale spot where mindful eating meets exceptional flavor—without compromise.
                        </p>
                        <a href="{{ route('reservations') }}" class="menu-btn">Make a Reservation →</a>
                    </div>

                </div>

            </div>

        </div>
    </body>
@endsection
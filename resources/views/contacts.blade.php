@extends('layouts.app')
@section('navbar')
    <nav class="navbar navbar-expand-lg navbar-light  shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <div class="left-nav">
                    <div class="navbar-nav me-auto">
                        <div class="welcome-text">
                            <h1>Contact Us</h1>
                            <p>Have questions or need assistance? Reach out to us using the information below.</p>
                        </div>
                    </div>
                </div>


                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto right-nav">
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('menu') }}">Menu</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
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
                                <a class="dropdown-item" href="{{ route('home', Auth::user()->id) }}">
                                    {{ __('Home') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    {{ __('Profile') }}
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"> Actions

                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('menu') }}">Menu</a></li>
                                <li><a class="dropdown-item" href="{{ route('reservations') }}">Reservations</a></li>
                                <li><a class="dropdown-item" href="#">Membership</a></li>
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
    <div style="flex-direction: column; display: flex; align-items: center; color: white;">
        <h3>Open Hours</h3>
        <p>Every Day (Monday - Sunday): 6:00 AM - 8:00 PM</p>
        <hr style="border: white 1px solid; width: 30%;">
        <h3>Contact Information</h3>
        <p><strong>Phone:</strong> +1 (123) 456-7890</p>
        <p><strong>Email:</strong> info@fitsgood.com</p>
        <p><strong>Address:</strong> Honvéd tér 10/A, 1055, Budapest, Hungary</p>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10174.436722907483!2d19.04513774850714!3d47.51211297728945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dc0e13c7d003%3A0xf7a80c1b5b00e34e!2zQnVkYXBlc3QsIEhvbnbDqWQgdMOpciAxMC9hLCAxMDU1!5e0!3m2!1shu!2shu!4v1771952847478!5m2!1shu!2shu"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
            <hr>
            <hr style="border: white 1px solid; width: 30%;">
        <h3>Socials</h3>
        <p><strong>ⓕ Facebook:</strong> <a href="https://www.facebook.com/fitsgood" style="color: white;">facebook.com/fitsgood</a></p>
        <p><strong>🅾 𝐈𝐧𝐬𝐭𝐚𝐠𝐫𝐚𝐦:</strong> <a href="https://www.instagram.com/fitsgood" style="color: white;">instagram.com/fitsgood</a></p>
        <p><strong>【ꚠ】𝗧𝗶𝗸𝗼𝗸:</strong> <a href="https://www.tiktok.com/fitsgood" style="color: white;">tiktok.com/fitsgood</a></p>
    </div>

@endsection
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
                            <h1>Reserve a table</h1>
                            <p>Fill in the details below to reserve a table at Fit's Good.</p>
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
    <div style="display: flex; justify-content: center; width: 100%;">
        <p style="margin-top: 20px; font-size: 1.5rem; color: #afafaf; text-align: center; width: 500px; line-height: 1.6;">
            For groups of more than 10 people or special events, please contact us at <br>
            <a href="mailto:info@fitsgood.com" style="color: rgb(30, 193, 30); text-decoration: none;">info@fitsgood.com</a>
            <br>
            or call us at
            <a href="tel:+1234567890" style="color: rgb(30, 193, 30); text-decoration: none;">+1 (234) 567-890</a>.
        </p>
    </div>
    <section class="reservation-section"
        style="max-width: 500px; margin: 50px auto; padding: 40px; background: rgba(255, 255, 255, 0.05); border-radius: 15px; border: 1px solid rgba(255, 255, 255, 0.1); font-family: 'Playfair Display', serif; color: white;">

        <h2
            style="text-align: center; text-transform: uppercase; letter-spacing: 2px; border-bottom: 2px solid #afafaf; display: block; padding-bottom: 15px; margin-bottom: 30px;">
            Table Reservation
        </h2>

        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #afafaf;">Date of Visit</label>
                <input type="date" name="date" required min="{{ date('Y-m-d') }}"
                    style="width: 100%; padding: 12px; background: #222; border: 1px solid #444; color: white; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #afafaf;">Select Time (Hourly)</label>
                <select name="period" required
                    style="width: 100%; padding: 12px; background: #222; border: 1px solid #444; color: white; border-radius: 5px;">
                    <option value="" disabled selected>Choose an hour...</option>
                    @for ($hour = 6; $hour <= 19; $hour++)
                        <option value="{{ $hour }}">{{ sprintf('%02d:00', $hour) }}</option>
                    @endfor
                </select>
                <small style="color: #888; display: block; margin-top: 5px;">We are open from 06:00 to 20:00</small>
            </div>

            <div style="margin-bottom: 30px;">
                <label style="display: block; margin-bottom: 8px; color: #afafaf;">Number of Guests</label>
                <input type="number" name="guests" min="1" max="12" required
                    style="width: 100%; padding: 12px; background: #222; border: 1px solid #444; color: white; border-radius: 5px;">
            </div>

            <button type="submit"
                style="width: 100%; padding: 15px; background-color:rgb(16, 94, 16); color: gainsboro; border: none; border-radius: 5px; font-weight: bold; font-size: 1.1rem; cursor: pointer; text-transform: uppercase;">
                Confirm Reservation
            </button>
        </form>
    </section>
@endsection
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
    <main class="membership-container"
        style="max-width: 80%; margin: 50px auto; font-family: 'Playfair Display', serif; color: white; padding: 20px;">

        <h1
            style="text-align: center; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 50px; border-bottom: 2px solid #d4af37; display: inline-block; width: 100%; padding-bottom: 15px;">
            Membership Center
        </h1>

        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 40px; margin-bottom: 60px;">

            <div
                style="flex: 1; min-width: 300px; max-width: 400px; background: rgba(255,255,255,0.05); padding: 30px; border-radius: 15px; border: 1px solid #afafaf; text-align: center; opacity: {{ auth()->user()->is_premium ? '0.6' : '1' }};">
                <h2 style="text-transform: uppercase; color: #afafaf;">Basic Plan</h2>
                <div style="font-size: 2rem; margin: 20px 0;">FREE</div>
                <ul style="list-style: none; padding: 0; text-align: left; margin: 30px 0; line-height: 2;">
                    <li>✅ Table Reservation</li>
                    <li>✅ View Digital Menu</li>
                    <li>✅ Access to Basic Content</li>
                </ul>
                @if(!auth()->user()->is_premium)
                    <button disabled
                        style="padding: 15px 30px; background: #555; color: #aaa; border: none; border-radius: 5px;">Your
                        Current Plan</button>
                @endif
            </div>

            <div
                style="flex: 1; min-width: 300px; max-width: 400px; background: rgba(212, 175, 55, 0.05); padding: 30px; border-radius: 15px; border: 2px solid #d4af37; text-align: center;">
                <h2 style="text-transform: uppercase; color: #d4af37;">Premium Plan</h2>

                @if(auth()->user()->is_premium)
                    <div style="font-size: 1.2rem; color: #d4af37; margin: 20px 0; font-weight: bold;">★ PREMIUM ACTIVE ★</div>
                    <p style="color: #afafaf;">Scroll down to access your exclusive content.</p>
                @else
                    <div style="font-size: 2rem; margin: 20px 0;">$19.99</div>
                    <ul style="list-style: none; padding: 0; text-align: left; margin: 30px 0; line-height: 2;">
                        <li>✨ Exclusive Recipes</li>
                        <li>✨ Dietary Consultation</li>
                        <li>✨ Trainer Advice</li>
                    </ul>
                    @csrf
                    <div style="text-align: center; margin-top: 30px;">
                        <a href="{{ route('membership.upgrade') }}"
                            style="display: inline-block; border-radius: 5px; padding: 15px 30px; background-color: #1ec11e; color: black; text-decoration: none;">
                            Upgrade to Premium
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </main>

    
@endsection
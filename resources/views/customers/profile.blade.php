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
                            <p>You can view and update your profile information here.</p>
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

@section('content') <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="background-color: rgb(110, 129, 110); color: gainsboro;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ __('Here is your profile') }}</span>

                        <a href="{{ route('welcome') }}" class="btn" style="color: gainsboro">
                            &larr; {{ __('Back to Home') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $customer->custData->cust_name ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $customer->custContact->cust_email ?? 'N/A' }}</p>
                        <p><strong>Phone:</strong> {{ $customer->custContact->cust_phone_num ?? 'N/A' }}</p>
                        <p><strong>Gender:</strong> {{ $customer->custData->cust_gender ?? 'N/A' }}</p>
                        <p><strong>Age:</strong> {{ $customer->custData->cust_age ?? 'N/A' }}</p>
                        <hr>
                        <a href="{{ route('profile.edit') }}" style="background-color:  rgb(39, 76, 39); color: white;"
                            class="btn">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
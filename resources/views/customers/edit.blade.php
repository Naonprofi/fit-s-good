@extends('layouts.app')

@section('navbar')
    <nav class="navbar navbar-expand-lg navbar-light  shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <div class="left-nav">
                        <div class="navbar-nav me-auto">
                            <div class="welcome-text">
                                <h1>Welcome to Fit's Good!</h1>
                                <p>Your best friend in eating healthy without losing flavour. Track your macros and
                                    achieve your fitness goals with ease.</p>
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
    <div class="container">
        <form action="{{ route('customer.update', ['customer' => $customer->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label> <input type="text" class="form-control" id="cust_name"
                    name="cust_name" value="{{ old('cust_name', $customer->custData->cust_name ?? '') }}" required>
            </div>
            <div class="mb-3"> <label for="email" class="form-label">Email</label> <input type="email" class="form-control"
                    id="cust_email" name="cust_email"
                    value="{{ old('cust_email', $customer->custContact->cust_email ?? '') }}" required> </div>
            <div class="mb-3"> <label for="phone" class="form-label">Phone</label> <input type="text" class="form-control"
                    id="cust_phone_num" name="cust_phone_num"
                    value="{{ old('cust_phone_num', $customer->custContact->cust_phone_num ?? '') }}" required> </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="cust_gender" id="cust_gender" class="form-control">
                    @php $currentGender = old('cust_gender', $customer->custData->cust_gender ?? ''); @endphp
                    <option value="" disabled {{ $currentGender == '' ? 'selected' : '' }}>Choose your gender...</option>
                    <option value="male" {{ $currentGender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $currentGender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $currentGender == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="mb-3"> <label for="age" class="form-label">Age</label> <input type="text" class="form-control"
                    id="cust_age" name="cust_age" value="{{ old('cust_age', $customer->custData->cust_age ?? '') }}"
                    required> </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection
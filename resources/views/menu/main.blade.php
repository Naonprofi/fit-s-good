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
                            <h1>Menu</h1>
                            <p>Check out our delicious and healthy menu options!</p>
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
                                <li><a class="dropdown-item" href="{{ route('welcome') }}">Home</a></li>
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
    <style>
        /* Alapértelmezett (Mobil) nézet */
        .menu-grid {
            display: flex;
            flex-direction: column;
            /* Egymás alá rakja őket */
            gap: 40px;
            /* Távolság az egymás alatti elemek között */
            margin-top: 30px;
        }

        .menu-container {
            color: white;
            /* Fehér szöveg mindenhol */
            max-width: 1000px;
            /* Kicsit szélesebbre vettem, hogy PC-n kényelmesebb legyen */
            margin: 0 auto;
            text-align: center;
            font-family: 'Playfair Display', serif;
            padding: 20px;
        }

        .menu-item img {
            width: 100%;
            max-width: 400px;
            /* Ne legyen túl óriási a kép mobilon sem */
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        /* PC / Tablet nézet (768px felett) */
        @media (min-width: 768px) {
            .menu-grid {
                flex-direction: row;
                /* Egymás mellé rakja őket */
                justify-content: center;
                gap: 80px;
                /* Itt állíthatod, milyen messze legyenek egymástól PC-n */
            }

            .menu-item {
                flex: 1;
                max-width: 45%;
                /* Biztosítja, hogy ne érjenek össze */
            }
        }
    </style>

    <main class="menu-container">

        <section class="menu-section" style="margin-bottom: 60px; margin-top: 20px;">
            <h2
                style="text-transform: uppercase; letter-spacing: 3px; border-bottom: 2px solid #afafaf; display: inline-block; padding-bottom: 10px; margin-bottom: 20px;">
                Your Favourites
            </h2>

            <div class="menu-grid">
                <div class="menu-item">
                    <img src="{{ asset('images/barackoscsirke.jpg') }}" alt="Favourite Food 1">
                    <p style="margin-top: 15px; font-weight: bold; font-size: 1.3rem;">Chicken breast filled with camembert
                        and apricot, sided with rice</p>
                    <p style="font-size: 16px; opacity: 0.9;">513kcal - 79g carbs - 30g protein - 9g fat</p>
                </div>
                <div class="menu-item">
                    <img src="{{ asset('images/kecskesajt.jpg') }}" alt="Favourite Food 2">
                    <p style="margin-top: 15px; font-weight: bold; font-size: 1.3rem;">Grilled goat cheese sided with
                        rukkola salad</p>
                    <p style="font-size: 16px; opacity: 0.9;">350kcal - 20g carbs - 25g protein - 15g fat</p>
                </div>
            </div>
        </section>

        <hr style="width: 30%; border: 0; border-top: 1px solid rgba(255,255,255,0.2); margin: 50px auto;">

        <section class="menu-section">
            <h2
                style="text-transform: uppercase; letter-spacing: 3px; border-bottom: 2px solid #afafaf; display: inline-block; padding-bottom: 10px; margin-bottom: 20px;">
                Chef's Choice
            </h2>

            <div class="menu-grid">
                <div class="menu-item">
                    <img src="{{ asset('images/chickenleg.jpg') }}" alt="Chef's Choice 1">
                    <p style="margin-top: 15px; font-weight: bold; font-size: 1.3rem;">Baked chicken leg sided with red
                        cabbage</p>
                    <p style="font-size: 16px; opacity: 0.9;">420kcal - 30g carbs - 35g protein - 12g fat</p>
                </div>
                <div class="menu-item">
                    <img src="{{ asset('images/lecso.jpg') }}" alt="Chef's Choice 2">
                    <p style="margin-top: 15px; font-weight: bold; font-size: 1.3rem;">Baked chicken breast with Lecsó sided
                        with bulgur</p>
                    <p style="font-size: 16px; opacity: 0.9;">380kcal - 25g carbs - 30g protein - 10g fat</p>
                </div>
            </div>
        </section>
        <section class="menu-table-section" style="margin-top: 50px; padding: 20px;">
            <h2
                style="text-transform: uppercase; letter-spacing: 2px; border-bottom: 2px solid #afafaf; display: inline-block; padding-bottom: 5px; margin-bottom: 30px; color: white;">
                Full Menu Details
            </h2>

            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; margin-bottom: 40px;">
                @php
                    $categories = [
                        1 => 'Main Course',
                        2 => 'Dessert',
                        3 => 'Soup',
                        4 => 'Breakfast',
                        5 => 'Drink'
                    ];
                    $currentCategory = request('category_id');
                @endphp

                <a href="{{ route('menu') }}"
                    style="padding: 10px 20px; border-radius: 25px; text-decoration: none; font-weight: bold; transition: 0.3s;
                   {{ !$currentCategory ? 'background: #d4af37; color: black;' : 'border: 1px solid #d4af37; color: #d4af37;' }}">
                    All
                </a>

                @foreach($categories as $id => $name)
                    <a href="{{ route('menu', ['category_id' => $id]) }}"
                        style="padding: 10px 20px; border-radius: 25px; text-decoration: none; font-weight: bold; transition: 0.3s;
                                   {{ $currentCategory == $id ? 'background: #d4af37; color: black;' : 'border: 1px solid #d4af37; color: #d4af37;' }}">
                        {{ $name }}
                    </a>
                @endforeach
            </div>

            <div style="overflow-x: auto;">
                <table
                    style="width: 100%; border-collapse: collapse; color: white; font-family: 'Playfair Display', serif; text-align: left;">
                    <thead>
                        <tr
                            style="border-bottom: 2px solid #afafaf; text-transform: uppercase; font-size: 0.9rem; letter-spacing: 1px;">
                            <th style="padding: 15px 10px;">Name</th>
                            <th style="padding: 15px 10px;">Calories</th>
                            <th style="padding: 15px 10px;">Protein</th>
                            <th style="padding: 15px 10px;">Carbs</th>
                            <th style="padding: 15px 10px;">Fat</th>
                            <th style="padding: 15px 10px; text-align: right;">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($foods as $item)
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); transition: background 0.3s;"
                                onmouseover="this.style.backgroundColor='rgba(255,255,255,0.05)'"
                                onmouseout="this.style.backgroundColor='transparent'">
                                <td style="padding: 15px 10px; font-weight: bold;">{{ $item->name }}</td>
                                <td style="padding: 15px 10px;">{{ $item->calories }} kcal</td>
                                <td style="padding: 15px 10px;">{{ $item->protein }}g</td>
                                <td style="padding: 15px 10px;">{{ $item->carbs }}g</td>
                                <td style="padding: 15px 10px;">{{ $item->fat }}g</td>
                                <td style="padding: 15px 10px; text-align: right; font-weight: bold; color: #d4af37;">
                                    {{ number_format($item->price, 0, ',', ' ') }} Ft
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 30px; text-align: center; color: #888;">No items found in
                                    this category.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
@endsection
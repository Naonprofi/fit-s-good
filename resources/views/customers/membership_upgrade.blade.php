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
                            <h1>Upgrade your Membership</h1>
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
    <main
        style="min-height: 100vh; display: flex; justify-content: center; align-items: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: white;">

        <div
            style="background-color: rgb(110, 129, 110); padding: 40px; border-radius: 20px; width: 100%; max-width: 400px; border: 1px solid #c0d0bf; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">

            <div id="payment-area">
                <h2 style="text-align: center; color: #ffffff; text-transform: uppercase; margin-bottom: 5px;">Upgrade to
                    Premium</h2>
                <p style="text-align: center; color: #ffffff; margin-bottom: 30px;">Amount: $19.99</p>

                <form id="payment-form">
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-size: 0.8rem; color: #ffffff; margin-bottom: 5px;">NAME ON
                            CARD</label>
                        <input type="text" id="holder" placeholder="Name..." required
                            style="width: 100%; padding: 12px; background: #222; border: 1px solid #444; color: white; border-radius: 5px; outline: none;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-size: 0.8rem; color: #ffffff; margin-bottom: 5px;">CARD
                            NUMBER</label>
                        <input type="text" id="number" placeholder="1234 5678 9101 1121" maxlength="16" required
                            style="width: 100%; padding: 12px; background: #222; border: 1px solid #444; color: white; border-radius: 5px; outline: none;">
                    </div>

                    <div style="display: flex; gap: 15px; margin-bottom: 25px;">
                        <div style="flex: 1;">
                            <label
                                style="display: block; font-size: 0.8rem; color: #ffffff; margin-bottom: 5px;">EXPIRY</label>
                            <input type="text" id="exp" placeholder="MM/YY" maxlength="5" required
                                style="width: 100%; padding: 12px; background: #222; border: 1px solid #444; color: white; border-radius: 5px; outline: none;">
                        </div>
                        <div style="flex: 1;">
                            <label
                                style="display: block; font-size: 0.8rem; color: #ffffff; margin-bottom: 5px;">CVC</label>
                            <input type="text" id="cvc" placeholder="123" maxlength="3" required
                                style="width: 100%; padding: 12px; background: #222; border: 1px solid #444; color: white; border-radius: 5px; outline: none;">
                        </div>
                    </div>

                    <button type="button" onclick="startPayment()" id="pay-btn"
                        style="width: 100%; padding: 15px; background-color: rgb(39, 76, 39); color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; text-transform: uppercase;">
                        Pay Now
                    </button>
                </form>
            </div>

            <div id="success-area" style="display: none; text-align: center;">
                <div style="font-size: 60px; color: #1ec11e; margin-bottom: 10px;">✔</div>
                <h2 style="color: white; margin-bottom: 10px;">Payment Successful!</h2>
                <p style="color: #afafaf; margin-bottom: 30px;">Thank you for your purchase. Your Premium plan is now
                    active.</p>

                <a href="/membership"
                    style="display: block; text-decoration: none; padding: 15px; background: #444; color: white; border-radius: 5px; font-weight: bold; text-transform: uppercase;">
                    Back to Membership
                </a>
            </div>

        </div>

    </main>

    <script>
        function startPayment() {
            // 1. Lekérjük az adatokat a mezőkből
            const name = document.getElementById('holder').value;
            const num = document.getElementById('number').value;
            const exp = document.getElementById('exp').value;
            const cvc = document.getElementById('cvc').value;

            // 2. Ellenőrizzük, hogy minden ki van-e töltve
            if (name === "" || num === "" || exp === "" || cvc === "") {
                alert("Please fill in all card details!");
                return; // Megállítjuk a folyamatot, ha valami hiányzik
            }

            // 3. Ha minden ki van töltve, elindítjuk a szimulációt
            const btn = document.getElementById('pay-btn');
            btn.disabled = true; // Kikapcsoljuk a gombot, ne lehessen többször rányomni
            btn.innerText = "Processing...";

            // 4. Várunk 2 másodpercet (szimuláljuk a bankot)
            setTimeout(() => {
                // Eltüntetjük a fizetési részt
                document.getElementById('payment-area').style.display = 'none';
                // Megmutatjuk a sikeres üzenetet
                document.getElementById('success-area').style.display = 'block';
            }, 2000);
        }
    </script>
@endsection
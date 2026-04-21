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
                            <h1>Premium</h1>
                            <p>Pay for exclusive features like premium workout plans and personalized nutrition guidance.
                            </p>
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
    <main style="min-height: 80vh; display: flex; justify-content: center; align-items: center; color: white;">

        <div
            style="background-color: rgb(110, 129, 110); padding: 40px; border-radius: 20px; width: 100%; max-width: 400px; border: 1px solid #c0d0bf; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">

            <div id="payment-area">
                <div class="card-header d-flex justify-content-end align-items-right">

                </div>
                <h2 style="text-align: center; text-transform: uppercase; margin-bottom: 5px;">Upgrade to Premium</h2>

                <p style="text-align: center; margin-bottom: 30px;">Amount: $5.00</p>

                <form id="payment-form">

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-size: 0.8rem; margin-bottom: 5px;">NAME ON CARD</label>
                        <input type="text" id="holder" placeholder="John Doe" required
                            style="width: 100%; padding: 12px; background: #222; border: 1px solid #444; color: white; border-radius: 5px;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-size: 0.8rem; margin-bottom: 5px;">CARD NUMBER</label>
                        <input type="text" id="number" placeholder="1234 5678 9101 1121" maxlength="16" required
                            pattern="\d{13,16}" inputmode="numeric"
                            style="width: 100%; padding: 12px; background: #222; border: 1px solid #444; color: white; border-radius: 5px;">
                    </div>

                    <div style="display: flex; gap: 15px; margin-bottom: 25px;">
                        <div style="flex: 1;">
                            <label style="display: block; font-size: 0.8rem; margin-bottom: 5px;">EXPIRY</label>
                            <input type="text" id="exp" placeholder="MM/YY" maxlength="5" required
                                pattern="\d{2}/\d{2}" placeholder="MM/YY"
                                style="width: 100%; padding: 12px; background: #222; border: 1px solid #444; color: white; border-radius: 5px;">
                        </div>
                        <div style="flex: 1;">
                            <label style="display: block; font-size: 0.8rem; margin-bottom: 5px;">CVC</label>
                            <input type="text" id="cvc" placeholder="123" maxlength="3" required
                                pattern="\d{3,4}" inputmode="numeric"
                                style="width: 100%; padding: 12px; background: #222; border: 1px solid #444; color: white; border-radius: 5px;">
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
                <h2 style="margin-bottom: 10px;">Payment Successful!</h2>
                <p style="color: #dfdfdf; margin-bottom: 20px;">Updating your account...</p>
            </div>

            <form id="hidden-finish-form" action="{{ route('membership.finish') }}" method="POST"
                style="display: none;">
                @csrf
            </form>

        </div>
    </main>

    <script>
        function startPayment() {
            function validateCardNumber(number) {
                let sum = 0;
                let isSecond = false;
                number = number.replace(/\s/g, '');

                for (let i = number.length - 1; i >= 0; i--) {
                    let d = parseInt(number[i]);
                    if (isSecond) {
                        d = d * 2;
                        if (d > 9) d = d - 9;
                    }
                    sum += d;
                    isSecond = !isSecond;
                }
                return (sum % 10 === 0) && number.length >= 13;
            }

            function validateExpiry(expiry) {
                const parts = expiry.split('/');
                if (parts.length !== 2) return false;

                const month = parseInt(parts[0], 10);
                const year = parseInt("20" + parts[1], 10);

                const now = new Date();
                const expiryDate = new Date(year, month - 1);

                return month >= 1 && month <= 12 && expiryDate > now;
            }
            const name = document.getElementById('holder').value;
            const num = document.getElementById('number').value;
            const exp = document.getElementById('exp').value;
            const cvc = document.getElementById('cvc').value;

            if (holder.length < 5) {
                alert("Write down the name on the card!");
                return;
            }

            if (!validateCardNumber(number)) {
                alert("Invalid card number!");
                return;
            }

            if (!validateExpiry(exp)) {
                alert("Invalid or expired date (MM/YY)!");
                return;
            }

            if (cvc.length < 3) {
                alert("Invalid CVC code!");
                return;
            }

            if (name === "" || num === "" || exp === "" || cvc === "") {
                alert("Please fill in all card details!");
                return;
            }

            const btn = document.getElementById('pay-btn');
            btn.disabled = true;
            btn.innerText = "Processing...";

            setTimeout(() => {
                document.getElementById('payment-area').style.display = 'none';
                document.getElementById('success-area').style.display = 'block';
                setTimeout(() => {
                    document.getElementById('hidden-finish-form').submit();
                }, 1000);
            }, 2000);
        }
    </script>
@endsection

@extends('layouts.app')

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
                        <a href="#" class="menu-btn">Check our MENU →</a>
                    </div>

                    <div class="col-lg-5 d-flex justify-content-center">
                        <div class="food-card">
                            <img src="{{ asset('images/fooldal1.png') }}" class="img-fluid w-75 rounded-4"
                                alt="Healthy food plate">
                            <span class="food-text">juhtúrós-sajtos sült brokkoli</span>
                        </div>
                    </div>

                    <div class="col-lg-5 d-flex justify-content-center">
                        <div class="food-card">
                            <img src="{{ asset('images/fooldal2.png') }}" class="img-fluid w-75 rounded-4"
                                alt="Charcuterie board">
                            <span class="food-text">grillezett csirkemellfilé bulgurral, párolt spárgával és
                                brokkolival</span>
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

                    <!-- BAL OLDAL: KÉP -->
                    <div class="col-12 col-lg-6 story-img text-center">
                        <img src="{{ asset('images/fooldal3.png') }}" alt="Story image">
                    </div>

                    <!-- JOBB OLDAL: SZÖVEG -->
                    <div class="col-12 col-lg-6 story-text">
                        <p>Fit’s Good is a contemporary restaurant founded by food enthusiasts who believed that healthy
                            cuisine can be both elegant and genuinely enjoyable.</p>

                        <hr class="story-divider">

                        <p>Their mission is simple: to create dishes from fresh, high-quality ingredients that are not only
                            nourishing but also offer a memorable dining experience. Over time, Fit’s Good has become a
                            refined, slightly upscale spot where mindful eating meets exceptional flavor—without compromise.
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </body>

@endsection
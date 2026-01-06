<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Fit's good</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom px-3">

            <!-- Bal oldali logó -->
            <a class="navbar-brand" href="#">FIT'S GOOD</a>

            <!-- Hamburger -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menü -->
            <div class="collapse navbar-collapse" id="mainMenu">

                <ul class="navbar-nav ms-auto">

                    <!-- Dropdown különállóan, nem a SIGN UP mellett -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Menü
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Menü</a></li>
                            <li><a class="dropdown-item" href="#">Asztalfoglalás</a></li>
                            <li><a class="dropdown-item" href="#">Nyitvatartás</a></li>
                            <li><a class="dropdown-item" href="#">Premium</a></li>
                            <li><a class="dropdown-item" href="#">Étrendek / Receptek</a></li>
                        </ul>
                    </li>

                </ul>

                <!-- SIGN UP külön jobbra -->
                <a href="#" class="signup-btn">SIGN UP</a>

            </div>

        </nav>

        @yield('mainContent')

        <footer>
            <p>alma</p>
        </footer>
    </div>
</body>

</html>
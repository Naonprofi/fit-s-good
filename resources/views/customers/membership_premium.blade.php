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
    <div class="container text-center" style="color: white; padding-top: 100px;">
        <h1 style="color: #d4af37;">Welcome to the Premium Club!</h1>
        <p>As a Premium member, you now have access to exclusive features and discounts.</p>

        <section id="premium-area" style="animation: fadeIn 1s ease-in; padding: 60px;">
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; align-items: stretch; padding-bottom: 50px;">

                <div style="background: rgba(255,255,255,0.03); padding: 25px; border-radius: 10px; border-left: 4px solid #d4af37; 
                    display: flex; flex-direction: column; height: 100%;">
                    <h3>📖 Dessert Recipes</h3>
                    <p style="color: #afafaf; font-size: 0.9rem;">Learn how to cook our signature healthy desserts at home.
                    </p>

                    <button onclick="toggleRecipes()"
                        style="margin-top: auto; background: none; border: 1px solid #d4af37; color: #d4af37; padding: 5px 15px; cursor: pointer; align-self: center;">
                        View Recipes
                    </button>
                </div>

                <div style="background: rgba(255,255,255,0.03); padding: 25px; border-radius: 10px; border-left: 4px solid #d4af37; 
                    display: flex; flex-direction: column; height: 100%;">
                    <h3>🥗 Dietary Consultation</h3>
                    <p style="color: #afafaf; font-size: 0.9rem;">Get a personalized meal plan based on your goals.</p>

                    <button onclick="alert('Ask our co-workers, they know everything!')"
                        style="margin-top: auto; background: none; border: 1px solid #d4af37; color: #d4af37; padding: 5px 15px; cursor: pointer; align-self: center;">
                        Book a session
                    </button>
                </div>

                <div style="background: rgba(255,255,255,0.03); padding: 25px; border-radius: 10px; border-left: 4px solid #d4af37; 
                    display: flex; flex-direction: column; height: 100%;">
                    <h3>💪 Trainer Advice</h3>
                    <p style="color: #afafaf; font-size: 0.9rem;">Direct chat with our professional trainers for workout
                        tips and personalized guidance.</p>

                    <button onclick="alert('Ask our co-workers, they know everything!')"
                        style="margin-top: auto; background: none; border: 1px solid #d4af37; color: #d4af37; padding: 5px 15px; cursor: pointer; align-self: center;">
                        Ask a Trainer
                    </button>
                </div>

            </div>

            <div id="hidden-recipe-section" <div
                style="text-align: left; max-width: 800px; margin: 0 auto; color: #f0f0f0; display: none;">
                <h3
                    style="color: #d4af37; border-bottom: 2px solid #d4af37; padding-bottom: 10px; margin-top: 30px; text-align: center;">
                    Premium Dessert Collection
                </h3>

                <div style="margin-bottom: 40px; background: rgba(255,255,255,0.05); padding: 20px; border-radius: 8px;">
                    <h4 style="color: #d4af37;">1. Somlói Trifle Cubes (Somlói kocka)</h4>
                    <p style="font-size: 0.8rem; color: #afafaf;">Nutritional info per serving: 160 kcal | 5g Protein | 26g
                        Carbs | 3g Fat</p>
                    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                        <div style="flex: 1; min-width: 250px;">
                            <strong style="color: #d4af37;">Ingredients:</strong>
                            <ul style="font-size: 0.9rem; list-style-type: square;">
                                <li>3 types of sponge cake (plain, cocoa, walnut)</li>
                                <li>Vanilla pastry cream (500ml milk, 4 yolks, sugar, vanilla)</li>
                                <li>Rum-infused chocolate sauce (100g dark chocolate, 50ml rum)</li>
                                <li>Roasted walnuts and raisins</li>
                                <li>Whipped cream for topping</li>
                            </ul>
                        </div>
                        <div style="flex: 2; min-width: 300px;">
                            <strong style="color: #d4af37;">Instructions:</strong>
                            <ol style="font-size: 0.9rem;">
                                <li>Layer the different sponge cakes in a deep dish.</li>
                                <li>Drench each layer with vanilla cream and sprinkle with walnuts and raisins soaked in
                                    rum.</li>
                                <li>Let it rest in the fridge for at least 6 hours.</li>
                                <li>Cut into cubes, drizzle with chocolate sauce, and garnish with fresh whipped cream.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 40px; background: rgba(255,255,255,0.05); padding: 20px; border-radius: 8px;">
                    <h4 style="color: #d4af37;">2. Hungarian Apple Pie (Almás pite)</h4>
                    <p style="font-size: 0.8rem; color: #afafaf;">Nutritional info per serving: 237 kcal | 7g Protein | 19g
                        Carbs | 14g Fat</p>
                    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                        <div style="flex: 1; min-width: 250px;">
                            <strong style="color: #d4af37;">Ingredients:</strong>
                            <ul style="font-size: 0.9rem; list-style-type: square;">
                                <li>500g flour, 250g butter, 2 yolks</li>
                                <li>1.5kg apples (grated)</li>
                                <li>150g sugar, 1 tbsp cinnamon</li>
                                <li>Breadcrumbs (to absorb juice)</li>
                            </ul>
                        </div>
                        <div style="flex: 2; min-width: 300px;">
                            <strong style="color: #d4af37;">Instructions:</strong>
                            <ol style="font-size: 0.9rem;">
                                <li>Knead the dough and divide it into two parts. Roll out the bottom layer.</li>
                                <li>Squeeze the juice out of the grated apples, mix with sugar and cinnamon.</li>
                                <li>Sprinkle breadcrumbs on the dough, add the apple filling, then cover with the second
                                    layer of dough.</li>
                                <li>Prick the top with a fork and bake at 180°C until golden brown.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 40px; background: rgba(255,255,255,0.05); padding: 20px; border-radius: 8px;">
                    <h4 style="color: #d4af37;">3. Ischler Cookies</h4>
                    <p style="font-size: 0.8rem; color: #afafaf;">Nutritional info per serving: 488 kcal | 13g Protein | 39g
                        Carbs | 30g Fat</p>
                    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                        <div style="flex: 1; min-width: 250px;">
                            <strong style="color: #d4af37;">Ingredients:</strong>
                            <ul style="font-size: 0.9rem; list-style-type: square;">
                                <li>300g flour, 200g butter, 100g ground walnuts</li>
                                <li>100g powdered sugar</li>
                                <li>Apricot or redcurrant jam</li>
                                <li>200g dark chocolate for glazing</li>
                            </ul>
                        </div>
                        <div style="flex: 2; min-width: 300px;">
                            <strong style="color: #d4af37;">Instructions:</strong>
                            <ol style="font-size: 0.9rem;">
                                <li>Make a shortcrust pastry from flour, butter, nuts, and sugar. Chill for 1 hour.</li>
                                <li>Cut into circles and bake at 170°C for 8-10 minutes.</li>
                                <li>Glue two cookies together with a thick layer of jam.</li>
                                <li>Dip the top into melted chocolate and let it set in a cool place.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 40px; background: rgba(255,255,255,0.05); padding: 20px; border-radius: 8px;">
                    <h4 style="color: #d4af37;">4. Redcurrant Slice (Ribizlis szelet)</h4>
                    <p style="font-size: 0.8rem; color: #afafaf;">Nutritional info per serving: 116 kcal | 4g Protein | 6g
                        Carbs | 8g Fat</p>
                    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 15px;">
                        <div style="flex: 1; min-width: 250px;">
                            <strong style="color: #d4af37;">Ingredients:</strong>
                            <ul style="font-size: 0.9rem; list-style-type: square;">
                                <li>For the base: 4 eggs, 4 tbsp sugar, 4 tbsp flour, 1/2 tsp baking powder</li>
                                <li>For the cream: 500g curd cheese (túró) or Greek yogurt, 150g powdered sugar, 1 vanilla
                                    bean</li>
                                <li>Topping: 300g fresh redcurrants, 1 pack of red cake glaze (gelatin)</li>
                            </ul>
                        </div>
                        <div style="flex: 2; min-width: 300px;">
                            <strong style="color: #d4af37;">Instructions:</strong>
                            <ol style="font-size: 0.9rem;">
                                <li>Whisk eggs with sugar until fluffy, fold in flour and baking powder. Bake the sponge at
                                    180°C for 15 mins.</li>
                                <li>Mix the curd cheese with sugar and vanilla until smooth. Spread it evenly over the
                                    cooled sponge.</li>
                                <li>Wash the redcurrants and scatter them over the cream layer.</li>
                                <li>Prepare the cake glaze according to the package instructions and pour it over the
                                    berries. Chill for 3 hours.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 40px; background: rgba(255,255,255,0.05); padding: 20px; border-radius: 8px;">
                    <h4 style="color: #d4af37;">5. Cocoa Cream Slice (Kakaós szelet)</h4>
                    <p style="font-size: 0.8rem; color: #afafaf;">Nutritional info per serving: 247 kcal | 4g Protein | 13g
                        Carbs | 20g Fat</p>
                    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 15px;">
                        <div style="flex: 1; min-width: 250px;">
                            <strong style="color: #d4af37;">Ingredients:</strong>
                            <ul style="font-size: 0.9rem; list-style-type: square;">
                                <li>For the dough: 2 cups flour, 1 cup sugar, 2 tbsp cocoa powder, 1 cup milk, 1 egg</li>
                                <li>For the filling: 200g butter, 150g powdered sugar, 2 tbsp cocoa powder</li>
                                <li>Glaze: 100g dark chocolate, 2 tbsp oil</li>
                            </ul>
                        </div>
                        <div style="flex: 2; min-width: 300px;">
                            <strong style="color: #d4af37;">Instructions:</strong>
                            <ol style="font-size: 0.9rem;">
                                <li>Mix the dough ingredients and bake in a medium tray at 170°C. Once cooled, cut the cake
                                    horizontally into two layers.</li>
                                <li>Cream the softened butter with sugar and cocoa powder until very light and fluffy.</li>
                                <li>Spread the cocoa cream between the two cake layers.</li>
                                <li>Melt the chocolate with oil and pour it over the top layer. Let it set in the fridge
                                    before slicing into rectangles.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    </section>
    </div>

    <script>
        function toggleRecipes() {
            var x = document.getElementById("hidden-recipe-section");
            if (x.style.display === "none") {
                x.style.display = "block";
                x.scrollIntoView({ behavior: 'smooth' });
            } else {
                x.style.display = "none";
            }
        }
    </script>
@endsection
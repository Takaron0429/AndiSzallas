<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Nunito:wght@300;700&display=swap"
        rel="stylesheet">
    <title>🌊 Balatoni Programok</title>
    <style>
        body {
            background: linear-gradient(to bottom, #87CEEB, #fdf6e3);
            font-family: 'Nunito', sans-serif;
            margin: 0;
        }

        .balaton-header {
            background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Balaton_15307.jpg/800px-Balaton_15307.jpg') center/cover;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            padding: 80px 0;
            text-align: center;
        }

        .balaton-header h1 {
            font-family: 'Pacifico', cursive;
            font-size: 3rem;
        }

        .custom-navbar {
            background: #0077b6;
        }

        .custom-navbar .nav-link {
            color: white !important;
            font-weight: bold;
            padding: 10px 15px;
        }

        .custom-navbar .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            background: white;
            border-radius: 15px;
        }

        .btn-balaton {
            background: #0077b6;
            color: white;
            font-weight: bold;
        }

        .btn-balaton:hover {
            background: #005f89;
        }

        .weather-box {
            background: rgba(255, 255, 255, 0.8);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .navbar {
            background-color: #0077b6;
        }

        .navbar .nav-link {
            color: white !important;
        }

        .section {
            padding: 50px 0;
            display: none;
        }

        .active-section {
            display: block;
        }

        .card {
            transition: 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .ratio {
            margin-bottom: 1rem;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .balaton-header h1 {
                font-size: 2.2rem;
            }
        }

        body {
            background: linear-gradient(to bottom, #87CEEB, #fdf6e3);
            font-family: 'Nunito', sans-serif;
        }

        .balaton-header {
            background: url('https://via.placeholder.com/1200x500?text=Balaton') center/cover;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            padding: 60px 0;
            text-align: center;
        }

        .balaton-header h1 {
            font-family: 'Pacifico', cursive;
            font-size: 3rem;
        }

        .navbar {
            background-color: #0077b6;
        }

        .navbar .nav-link {
            color: white !important;
            font-weight: bold;
        }

        .navbar-nav .nav-item {
            margin: 5px;
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            background: white;
            border-radius: 15px;
            padding: 20px;
        }

        .btn-balaton {
            background: #0077b6;
            color: white;
            font-weight: bold;
        }

        .btn-balaton:hover {
            background: #005f89;
        }

        .weather-box {
            background: rgba(255, 255, 255, 0.8);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .section {
            padding: 50px 0;
            display: none;
        }

        .active-section {
            display: block;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .balaton-header h1 {
                font-size: 2rem;
            }

            .card {
                margin-bottom: 15px;
            }

            .navbar-nav .nav-item {
                margin: 2px;
            }

            .navbar {
                padding: 10px;
            }

            .section h2 {
                font-size: 1.5rem;
            }
        }

        /* Custom CSS for image styling */
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .container-fluid {
            padding: 0 15px;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Balaton Programok</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav me-auto">
                    <a class="nav-link" href="/">Kezdőlap</a>
                    <a class="nav-link" href="#meglevo-velemenyek">Vélemények</a>
                    <a class="nav-link" href="foglalas">Foglalás</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HEADER -->
    <div class="balaton-header">
        <h1>Balatoni Programajánló</h1>
        <p>Fedezd fel a legjobb helyi eseményeket és élményeket!</p>
    </div>

    <!-- IDŐJÁRÁS ÉS TÉRKÉP EGY SORBAN -->
    <div class="container my-4">
        <div class="row">
            <div class="col-md-6">
                <div class="weather-box text-center p-3">
                    <h4>🌤 Aktuális időjárás</h4>
                    <p id="weather">Betöltés...</p>
                </div>
            </div>

            <div class="col-md-6">
                <h4 class="text-center">📍 Balaton térképe</h4>
                <div class="ratio ratio-16x9">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d107840.123456789!2d17.6500000!3d46.8500000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4769c7f7b1b1b1b1%3A0x1b1b1b1b1b1b1b1b!2sBalaton!5e0!3m2!1shu!2shu!4v1610000000000!5m2!1shu!2shu"
                        style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
    <style>
        .navbar {
            padding: 15px 30px;
            color: black;
        }
    
        .navbar-brand img {
            max-height: 50px;
        }
    
        .nav-link {
            font-size: 18px;
            color: black !important; /
            transition: font-weight 0.3s ease-in-out;

        }
    
        .nav-link:hover {
           font-weight: 900
        }
    
        .navbar-nav {
            list-style: none;
            padding-left: 0;
        }
    </style>
    <nav class="navbar  bg-white  text-dark">
        <div class="container my-4 align-items-center">
            <!-- Logó -->
            <a class="navbar-brand align-items-center" href="#">
                <img src="{{ asset('kepek/navbar.jpg') }}" alt="Balaton Programok" height="40" class="me-2">
                <span class="fw-bold  fs-4">Balaton Programok</span>
            </a>
    
            <!-- Menü -->
            <ul class="navbar-nav d-flex    color: black; flex-row gap-4" style="color: black; font-size: x-large;">
                <li class="nav-item"><a class="nav-link fw-bold text-dark" href="#" onclick="showSection('strandok')">🏖️ Strandok</a></li>
                <li class="nav-item"><a class="nav-link fw-bold text-dark" href="#" onclick="showSection('gasztro')">🍽️ Gasztrotérkép</a></li>
                <li class="nav-item"><a class="nav-link fw-bold text-dark" href="#" onclick="showSection('latnivalok')">🏛️ Látnivalók</a></li>
                <li class="nav-item"><a class="nav-link fw-bold text-dark" href="#" onclick="showSection('programok')">🎭 Programok</a></li>
                <li class="nav-item"><a class="nav-link fw-bold text-dark" href="#" onclick="showSection('szemesi')">🎉 Szemesi Napok</a></li>
            </ul>
        </div>
    </nav>
    
    
    <div class="container my-5">
        <!-- Gombok a szekciók közötti váltáshoz -->
        <div class="d-flex justify-content-center my-4">
            <button class="btn btn-primary mx-2" onclick="toggleSection('strandok')">Strandok</button>
            <button class="btn btn-primary mx-2" onclick="toggleSection('elmenyfurdok')">Élményfürdő</button>
        </div>

        <!-- Strandok szekció -->
        <div class="section" id="strandok">
            <h2 class="text-primary">🌊 Balatonszemesi Strandok</h2>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('kepek/hullam.jpg') }}" class="card-img-top" alt="Hullám utcai strand">
                        <div class="card-body">
                            <h5 class="card-title">Hullám utcai szabadstrand</h5>
                            <p class="card-text">Autóval, vonattal, autóbusszal könnyen megközelíthető. A parton pihenve
                                élvezhetjük a Balaton csodálatos panorámáját.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('kepek/berzsenyi.jpg') }}" class="card-img-top" alt="Berzsenyi strand">
                        <div class="card-body">
                            <h5 class="card-title">Berzsenyi Dániel utcai szabadstrand</h5>
                            <p class="card-text">Baba-Mama szoba és ingyenes parkolás várja a látogatókat. Tökéletes
                                választás családoknak, pihenésre és szórakozásra egyaránt.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('kepek/vigado.jpg') }}" class="card-img-top" alt="Vigadó strand">
                        <div class="card-body">
                            <h5 class="card-title">Vigadó utcai szabadstrand</h5>
                            <p class="card-text">A strand közvetlenül a vízparton található, gyönyörű kilátással a
                                Balatonra. Nagyobb társaságoknak és romantikus pihenéshez is ideális.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Élményfürdő szekció -->
        <div class="section" id="elmenyfurdok" style="display:none;">
            <h2 class="text-primary">🏊‍♂️ Balatonszemesi Élményfürdő</h2>
            <p><strong>📍 Cím:</strong> 8636 Balatonszemes, Berzsenyi Dániel u. 2</p>
            <p><strong>📞 Telefon:</strong> +36 30 158 72 76</p>
            <p><strong>📅 Nyitvatartás:</strong> Jelenleg ZÁRVA</p>
            <p><strong>Várható nyitás:</strong> 2025 június</p>
            <p><strong>Üzemeltető:</strong> Balatonszemes Község Önkormányzata</p>

            <h4>🎟 Belépő árak 2024</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Leírás</th>
                        <th>Idő</th>
                        <th>Ár</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Felnőtt belépő</td>
                        <td>2 órás</td>
                        <td>1.900,-Ft</td>
                    </tr>
                    <tr>
                        <td>Gyermek belépő</td>
                        <td>2 órás</td>
                        <td>1.200,-Ft</td>
                    </tr>
                    <tr>
                        <td>Nyugdíjas belépő</td>
                        <td>2 órás</td>
                        <td>1.200,-Ft</td>
                    </tr>
                    <tr>
                        <td>Családi belépő (1+1)</td>
                        <td>2 órás</td>
                        <td>2.300,-Ft</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <style>
        body {
            background: linear-gradient(to bottom, #87CEEB, #fdf6e3);
            font-family: 'Nunito', sans-serif;
            color: #333;
        }

        h2 {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 30px;
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.2rem;
            color: #0077b6;
        }

        .card-text {
            font-size: 1rem;
            color: #555;
        }

        .btn {
            font-weight: bold;
            border-radius: 5px;
        }

        .btn-primary {
            background: #0077b6;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1.1rem;
        }

        .btn-primary:hover {
            background: #005f89;
        }

        .section {
            display: none;
        }

        /* Reszponzív design */
        @media (max-width: 768px) {
            .card {
                margin-bottom: 20px;
            }

            .card-body {
                padding: 15px;
            }

            .btn {
                font-size: 1rem;
                padding: 8px 16px;
            }

            .container {
                padding: 15px;
            }
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.5rem;
            }

            .card-img-top {
                height: 150px;
            }

            .card-body {
                padding: 10px;
            }

            .btn {
                font-size: 0.9rem;
                padding: 6px 12px;
            }
        }
    </style>
    <div class="container my-6" id="gasztro"
        style="background-image: url('{{ asset('kepek/Hatter2.jpg') }}'); background-size: cover; background-position: center; border-radius: 15px; padding: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <h2 class="text-primary text-center mb-4">🍽️ Balatoni Gasztrotérkép – Legjobb Éttermek Balatonszemesen</h2>

        <div class="row">

            <!-- Kistücsök Étterem -->
            <div class="col-lg-4 col-md-6 col-sm-12 col-xsm-12 ">
                <div class="card shadow-lg border-0 rounded-3">
                    <img src="{{ asset('kepek/tucsok.jpg') }}" class="card-img-top rounded-3" alt="Kistücsök Étterem">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-dark">Kistücsök Étterem</h5>
                        <h7 style="font-style: italic; " class=" text-center text-dark">"A balatoni gasztroforradalom
                            epicentruma"</h7>
                        <p class="card-text text-center">Helyi alapanyagokra épülő, modern magyar konyhát kínáló
                            étterem. A séfek friss alapanyagokkal dolgoznak, és az étlap folyamatosan változik.</p>
                        <p><strong>Példák az ételre:</strong><br>
                            - Rántott hal Balaton szeletekkel<br>
                            -Véreshurka ropogós bundába<br>
                            - Grillezett lazac bazsalikomos pürével<br>

                        </p>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                        <div>
                            <strong> Átlag Ár:</strong> <span
                                class="badge bg-warning">{{ round(random_int(3500, 9000) / 100) * 100 }} Ft</span>
                        </div>
                        <a href="http://www.kistucsok.hu/" class="btn btn-primary" target="_blank">Weboldal</a>
                    </div>
                    <div class="card-footer bg-light">
                        <strong>Értékelés: 4.5/5</strong>
                        <div>

                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= 4.5)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                            <span> 4.5</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nessie Vendéglő és Bisztró -->
            <div class="col-lg-4 col-md-6 col-sm-12 col-xsm-12">
                <div class="card shadow-lg border-0 rounded-3">
                    <img src="{{ asset('kepek/nessi.jpg') }}" class="card-img-top rounded-3"
                        alt="Nessie Vendéglő és Bisztró">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-dark">Nessie Vendéglő és Bisztró</h5>
                        <p class="card-text text-center">Barátságos bisztró változatos étlappal és hangulatos
                            környezettel. A helyi specialitások mellett rengeteg nemzetközi ételt is kínálnak.</p>
                        <p><strong>Példák az ételre:</strong><br>
                            - Sült kacsa comb édesburgonyával<br>
                            - Pörkölt túrós csuszával<br>
                            - Friss saláták házi dresszinggel<br>
                            - Gulyásleves házi kenyérrel
                        </p>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Ár:</strong> <span
                                class="badge bg-warning">{{ round(random_int(2500, 5000) / 100) * 100 }} Ft</span>
                        </div>
                        <a href="http://www.nessie.hu/" class="btn btn-primary" target="_blank">Weboldal</a>
                    </div>
                    <div class="card-footer bg-light">
                        <strong>Értékelés: 4.3/5</strong>
                        <div>
                            <!-- Értékelés: 4.3 csillag -->
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= 4.3)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                            <span> 4.3</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 col-sm-12 col-xsm-12">
                <div class="card shadow-lg border-0 rounded-3">
                    <img src="{{ asset('kepek/marylou.jpg') }}" class="card-img-top rounded-3" alt="Mary Lou Pizzéria">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-dark">Mary Lou Pizzéria</h5>
                        <p class="card-text text-center">Kiváló pizzák és olasz ételek széles választéka családias
                            hangulatban. A helyi ízek mellett próbálj ki egy olasz klasszikust is!</p>
                        <p><strong>Példák az ételre:</strong><br>
                            - Margherita pizza<br>
                            - Quattro Formaggi pizza<br>
                            - Lasagne bolognese<br>
                            - Tiramisu házi készítésű
                        </p>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Ár:</strong> <span
                                class="badge bg-warning">{{ round(random_int(2500, 5000) / 100) * 100 }} Ft</span>
                        </div>
                        <a href="http://www.marylou.hu/" class="btn btn-primary" target="_blank">Weboldal</a>
                    </div>
                    <div class="card-footer bg-light">
                        <strong>Értékelés: 4.2/5</strong>
                        <div>
                            <!-- Értékelés: 4.2 csillag -->
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= 4.2)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                            <span> 4.2</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <br>

        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-12 col-xsm-12">
                <div class="card shadow-lg border-0 rounded-3">
                    <img src="{{ asset('kepek/csikos.jpg') }}" class="card-img-top rounded-3" alt="Csíkos Bisztró">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-dark">Csíkos Bisztró</h5>
                        <p class="card-text text-center">Kávézó, fagyizó és bisztró egy helyen, kellemes környezetben, a
                            Balaton partján.</p>
                        <p><strong>Példák az ételre:</strong><br>
                            - Halászlé házi túrós lepénnyel<br>
                            - Rántott pulykamell rizibizivel<br>
                            - Fagylaltválaszték szezonális ízekben<br>
                            - Vegán szendvicsek
                        </p>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Ár:</strong> <span
                                class="badge bg-warning">{{ round(random_int(2500, 5000) / 100) * 100 }} Ft</span>
                        </div>
                        <a href="http://www.csikos.hu/" class="btn btn-primary" target="_blank">Weboldal</a>
                    </div>
                    <div class="card-footer bg-light">
                        <strong>Értékelés: 4.0/5</strong>
                        <div>

                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= 4)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                            <span> 4.0</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 col-sm-12 col-xsm-12">
                <div class="card shadow-lg border-0 rounded-3">
                    <img src="{{ asset('kepek/thomas.jpg') }}" class="card-img-top rounded-3" alt="Thomas Pub Pizzéria">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-dark">Thomas Pub Pizzéria</h5>
                        <p class="card-text text-center">Pizzák, pub ételek és italok széles választéka egy helyen, a
                            Balaton partján.</p>
                        <p><strong>Példák az ételre:</strong><br>
                            - Baconös pizza<br>
                            - Fűszeres sült csirkecombok<br>
                            - Házi sütemények és piték<br>

                        </p>
                        Éjszakai Diszkó
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Ár:</strong> <span
                                class="badge bg-warning">{{ round(random_int(2500, 5000) / 100) * 100 }} Ft</span>
                        </div>
                        <a href="http://www.thomas.hu/" class="btn btn-primary" target="_blank">Weboldal</a>
                    </div>
                    <div class="card-footer bg-light">
                        <strong>Értékelés: 4.3/5</strong>
                        <div>

                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= 4.3)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                            <span> 4.3</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Torony Vendéglő -->
            <div class="col-lg-4 col-md-6 col-sm-12 col-xsm-12">
                <div class="card shadow-lg border-0 rounded-3">
                    <img src="{{ asset('kepek/torony.jpg') }}" class="card-img-top rounded-3" alt="Torony Vendéglő">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-dark">Rock Burger</h5>
                        <p class="card-text text-center">Kedves, családias étterem helyi ételekkel és ínycsiklandó
                            fogásokkal. A régió ízeit egy modern köntösben tálalják.</p>
                        <p><strong>Példák az ételre:</strong><br>
                            - Gulyásleves házi kenyérrel<br>
                            - Sertéssült vegyes körettel<br>
                            -Hamburgerek
                        </p>
                    </div>
                    <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Ár:</strong> <span
                                class="badge bg-warning">{{ round(random_int(2500, 5000) / 100) * 100 }} Ft</span>
                        </div>
                        <a href="http://www.torony.hu/" class="btn btn-primary" target="_blank">Weboldal</a>
                    </div>
                    <div class="card-footer bg-light">
                        <strong>Értékelés: 4.1/5</strong>
                        <div>
                            <!-- Értékelés: 4.1 csillag -->
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= 4.1)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                            <span> 4.1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="container my-5" id="szemesi">
        <h2 class="text-primary text-center">🎉 Szemes Napok – Augusztusi Fesztivál</h2>
        <p class="text-center text-muted">Balatonszemes legnagyobb nyári rendezvénye</p>

        <div id="szemesCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset("kepek/napok1.jpg")}}" class="d-block w-100" alt="Szemes Napok Koncert">
                </div>
                <div class="carousel-item">
                    <img src="{{asset("kepek/napok2.jpg")}}" class="d-block w-100" alt="Kézműves Vásár">
                </div>
                <div class="carousel-item">
                    <img src="{{asset("kepek/napok3.jpg")}}" class="d-block w-100" alt="Gasztronómiai Bemutató">
                </div>
                <div class="carousel-item">
                    <img src="{{asset("kepek/nyart.png")}}" class="d-block w-100" alt="Gasztronómiai Bemutató">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#szemesCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#szemesCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <h3 class="text-secondary">📅 Főbb Programok</h3>
        <div class="row">
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item"><strong>🎶 Koncertek:</strong> Híres magyar előadók és zenekarok
                    </li>
                    <li class="list-group-item"><strong>🛍 Kézműves Vásár:</strong> Egyedi kézműves termékek és
                        helyi alkotók</li>
                    <li class="list-group-item"><strong>🍽 Gasztroélmények:</strong> Balatoni borok, helyi ételek és
                        street food</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item"><strong>🎭 Színházi előadások:</strong> Szabadtéri kulturális
                        programok</li>
                    <li class="list-group-item"><strong>👨‍👩‍👧‍👦 Családi programok:</strong> Játszóház, ugrálóvár
                        és interaktív foglalkozások</li>
                    <li class="list-group-item"><strong>🎆 Tűzijáték:</strong> A fesztivál záróeseménye</li>
                </ul>
            </div>
        </div>

        <h3 class="text-secondary mt-4">📍 Helyszín és Hasznos Információk</h3>
        <p><strong>📌 Helyszín:</strong> Balatonszemes Fő tér és Kikötő környéke</p>
        <p><strong>💰 Belépés:</strong> A rendezvény ingyenesen látogatható</p>
        <p><strong>🚗 Parkolás:</strong> Ingyenes és fizetős parkolóhelyek elérhetők</p>

        <div class="text-center mt-4">
            <a href="https://balatonszemes.hu" class="btn btn-primary" target="_blank">További információk</a>
        </div>
    </div>

    <div class="container my-5 section" id="latnivalok" style="display: none;">
        <h2 class="text-primary text-center">🏛️ Balatonszemesi Látnivalók</h2>
        <p class="text-muted text-center">Fedezd fel Balatonszemes kulturális és természeti kincseit!</p>

        <div class="row">

            <!-- Latinka Ház -->
            <div class="col-md-6 mb-4">
                <div class="location-item shadow-sm rounded-3 overflow-hidden">
                    <img src="{{ asset('kepek/latino.jpg') }}" class="w-100 h-100" alt="Latinka Ház">
                    <div class="location-content p-4">
                        <h5 class="location-title">🏠 Latinka Ház</h5>
                        <p class="location-description">
                            A Latinka Ház helytörténeti gyűjteményt és kiállításokat kínál a látogatóknak, betekintést
                            nyújtva Balatonszemes múltjába.
                        </p>
                        <p><strong>📍 Cím:</strong> 8636 Balatonszemes, Bajcsy-Zsilinszky utca 5.</p>
                        <p><strong>⏰ Nyitvatartás:</strong> H-P: 10:00 - 18:00, Szo-V: 10:00 - 14:00</p>
                        <p><strong>📞 Telefon:</strong> +36 30 123 4567</p>
                        <a href="https://goo.gl/maps/X2H6JpNQfYG2" class="btn btn-primary" target="_blank">📍 Google
                            Maps</a>
                    </div>
                </div>
            </div>

            <!-- Postamúzeum -->
            <div class="col-md-6 mb-4">
                <div class="location-item shadow-sm rounded-3 overflow-hidden">
                    <img src="{{ asset('kepek/posta.jpg') }}" class="w-100 h-100" alt="Postamúzeum">
                    <div class="location-content p-4">
                        <h5 class="location-title">📮 Postamúzeum</h5>
                        <p class="location-description">
                            Magyarország egyik legrégebbi postamúzeuma, amely a postaszolgálat múltját és fejlődését
                            mutatja be.
                        </p>
                        <p><strong>📍 Cím:</strong> 8636 Balatonszemes, Bajcsy-Zsilinszky u. 46.</p>
                        <p><strong>⏰ Nyitvatartás:</strong> H-P: 9:00 - 17:00, Szo-V: 10:00 - 16:00</p>
                        <p><strong>📞 Telefon:</strong> +36 84 555 1234</p>
                        <a href="https://goo.gl/maps/Yz1FgKZNXPr" class="btn btn-primary" target="_blank">📍 Google
                            Maps</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-4">
                <div class="location-item shadow-sm rounded-3 overflow-hidden">
                    <img src="{{ asset('kepek/var.jpg') }}" class="w-100 h-50" alt="Bagolyvár">
                    <div class="location-content p-4">
                        <h5 class="location-title">🏰 Bagolyvár</h5>
                        <p class="location-description">
                            A Bagolyvár Balatonszemes egyik legikonikusabb épülete, amelynek különleges tornyai és
                            mesebeli megjelenése magával ragadja a látogatókat. Az épület 1898-ban készült, és a helyiek
                            szerint egykor egy „Bolondvár” nevű romos épület állt a helyén. A Bagolyvár sajátos
                            építészeti stílusa és történelme miatt népszerű fotós helyszín és kedvelt turisztikai
                            látványosság.
                        </p>
                        <p><strong>📍 Cím:</strong> 8636 Balatonszemes, Bagolyvár utca</p>
                        <p><strong>ℹ️ Megjegyzés:</strong> Magántulajdonban van, így csak kívülről tekinthető meg.</p>
                        <a href="https://goo.gl/maps/X2H6JpNQfYG2" class="btn btn-primary" target="_blank">📍 Google
                            Maps</a>
                    </div>
                </div>
            </div>


            <div class="col-md-6 mb-4">
                <div class="location-item shadow-sm rounded-3 overflow-hidden">
                    <img src="{{ asset('kepek/ancsi.jpg') }}" class="w-100 h-40" alt="Ancsika Kertmozi">
                    <div class="location-content p-4">
                        <h5 class="location-title">🎬 Ancsika Kertmozi és Kultkert</h5>
                        <p class="location-description">
                            Az Ancsika Kertmozi nem csupán egy egyszerű szabadtéri mozi, hanem egy valódi kulturális
                            központ, ahol a balatoni nyári esték felejthetetlen élménnyé válnak. A mozi közel 70 éve
                            működik, és generációk nőttek fel a hangulatos fa padokon, a csillagos ég alatt nézve a
                            legújabb és klasszikus filmeket. Emellett különböző koncertekkel, gyermekprogramokkal és
                            tematikus estekkel is várják a látogatókat. Ha egy igazán autentikus balatoni élményre
                            vágysz, az Ancsika Kertmozi kihagyhatatlan!
                        </p>
                        <p><strong>📍 Cím:</strong> 8636 Balatonszemes, Vak Bottyán utca 20.</p>
                        <p><strong>⏰ Nyitvatartás:</strong> Június végétől augusztus végéig</p>
                        <a href="https://goo.gl/maps/XY7TBgF5zNK2" class="btn btn-primary" target="_blank">📍 Google
                            Maps</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <!-- Bujtor István síremlék -->
            <div class="col-md-6 mb-4">
                <div class="location-item shadow-sm rounded-3 overflow-hidden">
                    <img src="{{ asset('kepek/bujtor.jpg') }}" class="w-100 h-50" alt="Bujtor István síremlék">
                    <div class="location-content p-4">
                        <h5 class="location-title">🕯️ Bujtor István Síremlék</h5>
                        <p class="location-description">
                            Bujtor István (szül: Frenreisz István) 1942 – 2009, színművész, színházigazgató, filmrendező
                            és forgatókönyvíró.
                            A síremlék felavatása 69. születésnapján történt, Melocco Miklós Kossuth-díjas
                            szobrászművész alkotásaként.
                        </p>
                        <p><strong>📍 Cím:</strong> Balatonszemes</p>
                        <p><strong>📝 Leírás:</strong> A síremlék a közönség és Bujtor István emléke előtt tiszteleg, a
                            csuklya és a színházi függöny részletei is tiszteletadásként jelennek meg.</p>

                    </div>
                </div>
            </div>

            <!-- Latinovits Zoltán Emlékház -->
            <div class="col-md-6 mb-4">
                <div class="location-item shadow-sm rounded-3 overflow-hidden">
                    <img src="{{ asset('kepek/latin.jpg') }}" class="w-100 h-100" alt="Latinovits Zoltán Emlékház">
                    <div class="location-content p-4">
                        <h5 class="location-title">🎭 Latinovits Zoltán Emlékház</h5>
                        <p class="location-description">
                            Latinovits Zoltán (1931–1976), a "színészkirály", művészetét bemutató állandó kiállítás,
                            dokumentumok és fotók tükrében.
                        </p>
                        <p><strong>📍 Cím:</strong> Balatonszemes</p>
                        <p><strong>⏰ Nyitvatartás:</strong> Április 1-től október 31-ig</p>
                        <ul>
                            <li><strong>Hétfő:</strong> Zárva</li>
                            <li><strong>Kedd - Csütörtök:</strong> 9:30 - 15:30</li>
                            <li><strong>Péntek - Szombat:</strong> 9:00 - 17:00</li>
                            <li><strong>Vasárnap:</strong> 9:00 - 15:00</li>
                        </ul>
                        <p><strong>Belépőjegy:</strong> Felnőtt: 700.-Huf, Diák/nyugdíjas: 350.-Huf</p>
                        <p><strong>Email:</strong> <a href="mailto:titkarsag@smmi.hu">titkarsag@smmi.hu</a></p>
                        <a href="https://goo.gl/maps/XY7TBgF5zNK2" class="btn btn-primary" target="_blank">📍 Google
                            Maps</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <style>
        .location-item {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .location-item img {
            object-fit: cover;
            width: 100%;
            height: 200px;
        }

        .location-content {
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
            border-radius: 0 0 15px 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .location-title {
            font-size: 1.25rem;
            color: #007bff;
            margin-bottom: 15px;
        }

        .location-description {
            color: #555;
        }

        .btn {
            margin-top: auto;
            align-self: start;
        }

        @media (max-width: 768px) {
            .location-content {
                padding: 15px;
            }
        }
    </style>
    <div class="container my-5">
        @foreach($programok as $helyszin => $lista)
            <h2 class="text-primary mt-6">📍 {{ $helyszin }}</h2>
            <div class="row">
                @foreach($lista as $program)
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-3">
                            <img src="/kepek/balaton-15307.jpg" class="card-img-top" alt="Balatoni program">
                            <div class="card-body">
                                <h5 class="card-title">{{ $program->cim }}</h5>
                                <p class="card-text">{{ Str::limit($program->leiras, 100) }}</p>
                                <p><strong>📅 Dátum: </strong>
                                    {{ \Carbon\Carbon::parse($program->datum)->format('Y. m. d.') }}
                                </p>
                                <a href="{{ $program->link }}" class="btn btn-balaton w-100" target="_blank">Részletek</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <div class="container my-5">
        <footer style=" background-color: #0077b6; height: 100px;">
            <br>
            <div class="text-center" style=" font-size: large; font-weight: bolder; color: whitesmoke;">2025 @Copyright
                - Készitette: Takács Áron, Lőczi Gergő</div>
        </footer>
    </div>
    <style>
        .card {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            height: 200px;
            object-fit: cover;
        }

        .list-group-item {
            background-color: #f8f9fa;
        }

        @media (max-width: 768px) {
            .card:hover {
                transform: none;
            }
        }

        .carousel-item img {
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
        }

        .list-group-item {
            background-color: #f8f9fa;
        }

        @media (max-width: 768px) {
            .carousel-item img {
                height: 250px;
            }
        }
    </style>
    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.section').forEach(section => section.style.display = 'none');
            document.getElementById(sectionId).style.display = 'block';
        }

        fetch('https://api.open-meteo.com/v1/forecast?latitude=46.91&longitude=17.89&current_weather=true')
            .then(response => response.json())
            .then(data => {
                const weather = data.current_weather;
                document.getElementById('weather').innerHTML = `🌡 Hőmérséklet: ${weather.temperature}°C<br>💨 Szélerősség: ${weather.windspeed} km/h`;
            })
            .catch(error => {
                document.getElementById('weather').innerHTML = "❌ Nem sikerült betölteni az időjárást!";
            });
    </script>


</body>

</html>
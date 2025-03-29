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
    <link rel="stylesheet" href="{{ asset('Program.css') }}">
    <title>🌊 Balatoni Programok</title>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar text-white">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="{{ route('programok.Pindex') }}">Balaton Programok</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav me-auto">
                    <a class="nav-link text-white" href="{{ route('/') }}"><i class="fa fa-home"
                            style="font-size: 20px"></i> Kezdőlap</a>

                    <a class="nav-link text-white" href="{{ route('foglalas') }} ">
                        <i class="fa fa-calendar text-white" style="font-size: 20px"></i> Foglalás
                    </a>
                </div>

                <div class="navbar-contact-info">
                    <span class="contact-item">
                        <i class="fa fa-phone" style="font-size: 20px"></i> +06-30/560-1999
                    </span>
                    <span class="separator">|</span>
                    <span class="contact-item">
                        <i class="fa fa-envelope" style="font-size: 20px"></i> andi68andi@gmail.com
                    </span>
                    <span class="separator">|</span>
                    <span class="contact-item">
                        <i class="fa fa-map-marker" style="font-size: 20px"></i> Balatonszemes, Vörösmarty u. 42
                    </span>
                    <span class="separator">|</span>
                    <a href="https://facebook.com" class="contact-item">
                        <i class="fab fa-facebook-f text-white" style="font-size: 20px"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>



    <!-- HEADER -->
    <div class="balaton-header">
        <h1>Balatoni Programajánló</h1>
        <p>Fedezd fel a legjobb helyi eseményeket és élményeket!</p>
    </div>


    <div class="container my-4">
        <div class="row">
            <br>
            <div class="col-md-6">
                <h3 class="text-center text-white">📍 Balaton térképe</h3>

                <div class="ratio ratio-16x9">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d107840.123456789!2d17.6500000!3d46.8500000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4769c7f7b1b1b1b1%3A0x1b1b1b1b1b1b1b1b!2sBalaton!5e0!3m2!1shu!2shu!4v1610000000000!5m2!1shu!2shu"
                        style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            <br>
            <div class="col-md-6">
                <div class="weather-box text-center p-3">
                    <h4>🌤 Aktuális időjárás</h4>
                    <p id="weather">Betöltés...</p>
                </div>
                <br>
                <div class="weather-box text-center p-3">
                <h4>🎭 Következő esemény</h4>
                <h5>{{ $kozelgoProgram->cim }}</h5>
                <p>{{ $kozelgoProgram->leiras }}</p>
                <p><i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($kozelgoProgram->kezdet)->format('Y. m. d.') }}</p>
                <a href="{{ $kozelgoProgram->link }}" class="btn btn-primary">Részletek</a>
            </div>
        </div>
        
    </div>
    <br>
    <div class="col-12 ">
        <nav class="navbar navbar-expand-lg bg-white text-dark">
            <div class="container-fluid d-flex flex-column align-items-center text-center my-4">

                <a class="navbar-brand d-flex flex-column align-items-center" href="#">
                    <img src="{{ asset('kepek/navbar.jpg') }}" alt="Balaton Programok" height="40" class="w-100">
                    <span class="fw-bold fs-4 mt-2">Balaton Programok</span>
                </a>
    
                <!-- Menü gomb középre igazítva -->
                <button class="navbar-toggler mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
             
                <div class="collapse navbar-collapse mt-3" id="navbarNav">
                    <ul class="navbar-nav d-flex flex-column flex-lg-row gap-4 text-center">
                        <li class="nav-item"><a class="nav-link fw-bold text-dark" href="#strandok">🏖️ Strandok</a></li>
                        <li class="nav-item"><a class="nav-link fw-bold text-dark" href="#gasztro">🍽️ Gasztrotérkép</a></li>
                        <li class="nav-item"><a class="nav-link fw-bold text-dark" href="#latnivalok">🏛️ Látnivalók</a></li>
                        <li class="nav-item"><a class="nav-link fw-bold text-dark" href="#programok">🎭 Programok</a></li>
                        <li class="nav-item"><a class="nav-link fw-bold text-dark" href="#szemesi">🎉 Szemesi Napok</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container my-5">


        <div class="row" id="strandok">
            <div class="d-flex justify-content-center my-4">
                <div class="balaton-header">
                    <h1>Csobbanj Szemesen!</h1>

                </div>
            </div>

            <div class="col-6 col-md-6 mb-4">
                <div class="section-content">
                    <h2 class="text-primary">🏖 Balatonszemesi Szabadstrandok</h2>
                    <ul class="strand-list">
                        <li><span class="emoji">🏝️</span> <strong>Hullám utcai szabadstrand</strong>
                            <p>Autóval, vonattal, autóbusszal könnyen megközelíthető.</p>
                        </li>
                        <li><span class="emoji">👶</span> <strong>Berzsenyi Dániel utcai szabadstrand</strong>
                            <p>Baba-Mama szoba és ingyenes parkolás várja a látogatókat.</p>
                        </li>
                        <li><span class="emoji">🌅</span> <strong>Ady Endre utcai szabadstrand</strong>
                            <p>Gyerekbarát szolgáltatásokkal és parkolási lehetőséggel.</p>
                        </li>
                        <li><span class="emoji">🏖️</span> <strong>Kölcsey Ferenc utcai szabadstrand</strong>
                            <p>Kiváló helyszín a pihenésre, gyermekbarát környezet és ingyenes parkolás.</p>
                        </li>
                        <li><span class="emoji">🏖️</span> <strong>Pázmány Péter utcai szabadstrand</strong>
                            <p>Csendes, nyugodt strand ideális a pihenni vágyóknak, napsütéses helyen.</p>
                        </li>
                        <li><span class="emoji">⛱️</span> <strong>Váci Mihály utcai szabadstrand</strong>
                            <p>Szép panoráma és sokféle vízi sportolási lehetőség várja a látogatókat.</p>
                        </li>
                    </ul>

                    <h4>Ingyenes szolgáltatások minden strandon:</h4>
                    <ul>
                        <li>✅ WC (női, férfi)</li>
                        <li>✅ Mosdó</li>
                        <li>✅ Kültéri öltöző</li>
                        <li>✅ Gyermek játszótér</li>
                    </ul>
                </div>
            </div>



            <div class="col-6 col-md-6 mb-4">
                <div class="section-content">
                    <h2 class="text-primary">🏊‍♂️ Balatonszemesi Élményfürdő</h2>
                    <p><strong>📍 Cím:</strong> 8636 Balatonszemes, Berzsenyi Dániel u. 2</p>
                    <p><strong>📞 Telefon:</strong> +36 30 158 72 76</p>
                    <p><strong>📅 Nyitvatartás:</strong> Jelenleg ZÁRVA</p>
                    <p><strong>Várható nyitás:</strong> 2025 június</p>
                    <p><strong>Üzemeltető:</strong> Balatonszemes Község Önkormányzata</p>

                    <h4>🎟 Belépő árak 2024</h4>
                    <table class="price-table">
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
                            <tr>
                                <td>Családi belépő (2+1)</td>
                                <td>2 órás</td>
                                <td>3.700,-Ft</td>
                            </tr>
                            <tr>
                                <td>További gyermek</td>
                                <td>2 órás</td>
                                <td>600,-Ft</td>
                            </tr>
                        </tbody>
                    </table>

                    <h4>🚣‍♂️ Kiegészítő szolgáltatások</h4>
                    <p><strong>Napágy bérlés:</strong> 1.750,- Ft</p>
                    <p><strong>SUP bérlés:</strong> 2.200,- Ft / 1 óra</p>
                    <p><strong>Kajak-Kenu bérlés:</strong> 1.000,- Ft - 4.000,- Ft között</p>

                    <h4>🔒 Trezor bérlés</h4>
                    <ul>
                        <li>Trezor kicsi: 350,-Ft / 1 óra</li>
                        <li>Trezor nagy: 600,-Ft / 1 óra</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>


    <style>

    </style>


    <div class="container my-6" id="gasztro"
        style="background-image: url('{{ asset('kepek/Hatter2.jpg') }}'); background-size: cover; background-position: center; border-radius: 15px; padding: 30px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <h2 class="text-primary text-center mb-4">🍽️ Balatoni Gasztrotérkép – Legjobb Éttermek Balatonszemesen</h2>

        <div class="row">

            <!-- Kistücsök Étterem -->
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card shadow-lg border-0 rounded-3">
                    <img src="{{ asset('kepek/tucsok.jpg') }}" class="card-img-top rounded-3" alt="Kistücsök Étterem">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-dark">Kistücsök Étterem</h5>
                        <h7 style="font-style: italic; " class="text-center text-dark">"A balatoni gasztroforradalom
                            epicentruma"</h7>
                        <p class="card-text text-center">Helyi alapanyagokra épülő, modern magyar konyhát kínáló
                            étterem. A séfek friss alapanyagokkal dolgoznak, és az étlap folyamatosan változik.</p>
                        <p><strong>Példák az ételre:</strong><br>
                            - Rántott hal Balaton szeletekkel<br>
                            - Véreshurka ropogós bundába<br>
                            - Grillezett lazac bazsalikomos pürével
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
            <div class="col-lg-4  col-md-4 col-sm-12">
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

            <!-- Mary Lou Pizzéria -->
            <div class="col-lg-4 col-md-4 col-sm-12 ">
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

            <!-- Csíkos Bisztró -->
            <div class="col-lg-4 col-md-4 col-sm-12 ">
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

            <!-- Thomas Pub Pizzéria -->
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card shadow-lg border-0 rounded-3">
                    <img src="{{ asset('kepek/thomas.jpg') }}" class="card-img-top rounded-3" alt="Thomas Pub Pizzéria">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-dark">Thomas Pub Pizzéria</h5>
                        <p class="card-text text-center">Pizzák, pub ételek és italok széles választéka egy helyen, a
                            Balaton partján.</p>
                        <p><strong>Példák az ételre:</strong><br>
                            - Baconös pizza<br>
                            - Fűszeres sült csirkecombok<br>
                            - Házi sütemények és piték
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
            <div class="col-lg-4 col-md-4 col-sm-12 ">
                <div class="card shadow-lg border-0 rounded-3">
                    <img src="{{ asset('kepek/torony.jpg') }}" class="card-img-top rounded-3" alt="Torony Vendéglő">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-dark">Rock Burger</h5>
                        <p class="card-text text-center">Kedves, családias étterem helyi ételekkel és ínycsiklandó
                            fogásokkal. A régió ízeit egy modern köntösben tálalják.</p>
                        <p><strong>Példák az ételre:</strong><br>
                            - Gulyásleves házi kenyérrel<br>
                            - Sertéssült vegyes körettel<br>
                            - Hamburgerek
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
        </div> <!-- End of Second Row -->
    </div>
    <br>
    <div class="container my-5" id="szemesi">
        <h2 class="text-primary text-center">🎉 Szemes Napok – Augusztusi Fesztivál</h2>
        <h4 class="text-center ">Balatonszemes legnagyobb nyári rendezvénye</h4>

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
        <br>
        <hr>
        <h3 class="text-primary text-center">📅 Főbb Programok</h3>
        <hr>
        <br>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12">
                <ul class="list-group">
                    <li class="list-group-item"><strong>🎶 Koncertek:</strong> Híres magyar előadók és zenekarok
                    </li>
                    <li class="list-group-item"><strong>🛍 Kézműves Vásár:</strong> Egyedi kézműves termékek és
                        helyi alkotók</li>
                    <li class="list-group-item"><strong>🍽 Gasztroélmények:</strong> Balatoni borok, helyi ételek és
                        street food</li>
                        <li class="list-group-item"><strong>📌 Helyszín:</strong> Balatonszemes Fő tér és Kikötő környéke</li>
                </ul>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
                <ul class="list-group">
                    <li class="list-group-item"><strong>🎭 Színházi előadások:</strong> Szabadtéri kulturális
                        programok</li>
                    <li class="list-group-item"><strong>👨‍👩‍👧‍👦 Családi programok:</strong> Játszóház, ugrálóvár
                        és interaktív foglalkozások</li>
                    <li class="list-group-item"><strong>🎆 Tűzijáték:</strong> A fesztivál záróeseménye</li>
                    <li class="list-group-item"><strong>💰 Belépés:</strong> A rendezvény ingyenesen látogatható<</li>
                </ul>
            </div>
            
          
        </div>

        <div class="text-center mt-4">
            <a href="https://balatonszemes.hu" class="btn btn-primary" target="_blank">További információk</a>
        </div>
    </div>

    <div class="container my-5 " id="latnivalok">
        <h2 class="text-primary text-center">🏛️ Balatonszemesi Látnivalók</h2>
        <p class="text-muted text-center">Fedezd fel Balatonszemes kulturális és természeti kincseit!</p>

        <div class="row">

            <!-- Latinka Ház -->
            <div class="col-md-6 mb-4">
                <div class="location-item shadow-sm rounded-3 ">
                    <img src="{{ asset('kepek/latino.jpg') }}" class="w-100 h-50" alt="Latinka Ház">
                    <div class="location-content p-4">
                        <h5 class="location-title">🏠 Latinovits Zoltán Művelődési Ház</h5>
                        <p class="location-description">
                            A Latinovits Zoltán Művelődési Ház helytörténeti gyűjteményt és kiállításokat kínál a
                            látogatóknak, betekintést
                            nyújtva Balatonszemes múltjába. Valamint egyre több programot rendeznek itt mint előtte.
                        </p>
                        <p><strong>📍 Cím:</strong> 8636 Balatonszemes, Bajcsy-Zsilinszky utca 5.</p>
                        <p><strong>⏰ Nyitvatartás:</strong> H-P: 10:00 - 18:00, Szo-V: 10:00 - 14:00</p>
                        <p><strong>📞 Telefon:</strong> +36 30 123 4567</p>
                        <a href="https://www.google.com/maps/place/Latinovits+Zolt%C3%A1n+M%C5%B1vel%C5%91d%C3%A9si+H%C3%A1z/@46.808012,17.779872,19.64z/data=!4m6!3m5!1s0x4769b04a2aac014f:0xc2e052dcd08eca5a!8m2!3d46.8081303!4d17.7801002!16s%2Fg%2F1tf68vmc?entry=ttu&g_ep=EgoyMDI1MDMyNC4wIKXMDSoJLDEwMjExNDU1SAFQAw%3D%3D"
                            class="btn btn-primary" target="_blank">📍 Google
                            Maps</a>
                    </div>
                </div>
            </div>

            <!-- Postamúzeum -->
            <div class="col-md-6 mb-4">
                <div class="location-item shadow-sm rounded-3 ">
                    <img src="{{ asset('kepek/posta.jpg') }}" class="w-100 h-50" alt="Postamúzeum">
                    <div class="location-content p-4">
                        <h5 class="location-title">📮 Postamúzeum</h5>
                        <p class="location-description">
                            Magyarország egyik legrégebbi postamúzeuma, amely a postaszolgálat múltját és fejlődését
                            mutatja be.
                        </p>
                        <p><strong>📍 Cím:</strong> 8636 Balatonszemes, Bajcsy-Zsilinszky u. 46.</p>
                        <p><strong>⏰ Nyitvatartás:</strong> H-P: 9:00 - 17:00, Szo-V: 10:00 - 16:00</p>
                        <p><strong>📞 Telefon:</strong> +36 84 555 1234</p>
                        <a href="https://www.google.com/maps/place/Postam%C3%BAzeum,+Balatonszemes/@46.8078329,17.7808553,17.82z/data=!4m6!3m5!1s0x4769b1948671314d:0x1725e8d4779d175b!8m2!3d46.8065697!4d17.7808882!16s%2Fg%2F11t5d8txdn?entry=ttu&g_ep=EgoyMDI1MDMyNC4wIKXMDSoJLDEwMjExNDU1SAFQAw%3D%3D"
                            class="btn btn-primary" target="_blank">📍 Google
                            Maps</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-4">
                <div class="location-item shadow-sm rounded-3">
                    <img src="{{ asset('kepek/var.png') }}" class="w-100 h-50" alt="Bagolyvár">
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
                        <a href="https://www.google.com/maps/place/Villa+Bagolyv%C3%A1r/@46.8122122,17.777782,18.27z/data=!4m6!3m5!1s0x4769b1a549118487:0x9ffbc30fa6e29ede!8m2!3d46.8120395!4d17.7793032!16s%2Fg%2F11j6zm3c5v?entry=ttu&g_ep=EgoyMDI1MDMyNC4wIKXMDSoJLDEwMjExNDU1SAFQAw%3D%3D"
                            class="btn btn-primary" target="_blank">📍 Google Maps</a>
                    </div>
                </div>
            </div>


            <div class="col-md-6 mb-4">
                <div class="location-item shadow-sm rounded-3 ">
                    <img src="{{ asset('kepek/ancsi.jpg') }}" class="w-100 h-50" alt="Ancsika Kertmozi">
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
                        <a href="https://www.google.com/maps/place/Ancsika+Kertmozi+%C3%A9s+Kultkert/@46.8102067,17.7782269,18.27z/data=!4m6!3m5!1s0x4769b110122d6abb:0xf24d5abe02461de1!8m2!3d46.8096114!4d17.7790342!16s%2Fg%2F11jkwwb3zd?entry=ttu&g_ep=EgoyMDI1MDMyNC4wIKXMDSoJLDEwMjExNDU1SAFQAw%3D%3D"
                            class="btn btn-primary" target="_blank">📍 Google
                            Maps</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <!-- Bujtor István síremlék -->
            <div class="col-md-6 mb-4">
                <div class="location-item shadow-sm rounded-3 ">
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
                        <a href="https://www.google.com/maps/place/Balatonszemesi+temet%C5%91/@46.8103389,17.7829167,17.59z/data=!4m6!3m5!1s0x4769b04923ffffff:0x1b4af3de27502fc1!8m2!3d46.8095734!4d17.7834447!16s%2Fg%2F11y7cl2s9c?entry=ttu&g_ep=EgoyMDI1MDMyNC4wIKXMDSoJLDEwMjExNDU1SAFQAw%3D%3D"
                            class="btn btn-primary" target="_blank">📍 Google
                            Maps</a>
                    </div>
                </div>
            </div>

            <!-- Latinovits Zoltán Emlékház -->
            <div class="col-md-6 mb-4">
                <div class="location-item shadow-sm rounded-3 ">
                    <img src="{{ asset('kepek/latin.jpg') }}" class="w-100 h-50" alt="Latinovits Zoltán Emlékház">
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
                        <a href="https://www.google.com/maps/place/Latinovits+Zolt%C3%A1n+Eml%C3%A9kki%C3%A1ll%C3%ADt%C3%A1s/@46.8071269,17.7802298,16.68z/data=!4m6!3m5!1s0x4769b04bb06399af:0xf49d633b371b800a!8m2!3d46.8062138!4d17.7798627!16s%2Fg%2F11yvn41wm?entry=ttu&g_ep=EgoyMDI1MDMyNC4wIKXMDSoJLDEwMjExNDU1SAFQAw%3D%3D"
                            class="btn btn-primary" target="_blank">📍 Google
                            Maps</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <style>

    </style>
    <div class="container my-5" id="programok">
        <h2 class="text-primary text-center">Programok a Balaton Déli-Partján</h2>
        <div class="accordion" id="programokAccordion">
            @foreach($programok as $helyszin => $lista)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $loop->index }}">
                        <button class="accordion-button @if(!$loop->first) collapsed @endif" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}"
                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $loop->index }}">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i> {{ $helyszin }}
                        </button>
                    </h2>
                    <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse @if($loop->first) show @endif"
                        aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#programokAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                @foreach($lista as $program)
                                    <div class="col-12 mb-4">
                                        <div class="card shadow-sm border-0 rounded">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <img src="{{asset('kepek/'.$program->kep )}}" class="img-fluid rounded-start"
                                                        alt="{{ $program->cim }}" style="height: 100%; object-fit: cover;">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-primary fw-bold">{{ $program->cim }}</h5>
                                                        <p class="card-text">{{ Str::limit($program->leiras, 150) }}</p>
                                                        <p class="text-muted">
                                                            <i class="fas fa-calendar-alt"></i>
                                                            {{ \Carbon\Carbon::parse($program->kezdet)->format('Y. m. d.') }} –
                                                            {{ \Carbon\Carbon::parse($program->vege)->format('Y. m. d.') }}
                                                        </p>
                                                        <a href="{{ $program->link }}" class="btn btn-primary">Részletek</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <style>

    </style>

    <footer class="footer">
        <!-- Hullám SVG -->
        <div class="wave-container">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ffffff" fill-opacity="0.2"
                    d="M0,64L48,85.3C96,107,192,149,288,165.3C384,181,480,171,576,138.7C672,107,768,53,864,74.7C960,96,1056,192,1152,234.7C1248,277,1344,267,1392,261.3L1440,256L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
                </path>
            </svg>
        </div>

        <div class="container">
            <div class="row align-items-center">
                <!-- Google Térkép -->
                <div class="col-md-6 col-12 mb-3">
                    <iframe loading="lazy" allowfullscreen
                        src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJcfmOyAexaUcRbfSI-AjnSfA&key=AIzaSyDClC5YHmbvEWO_pWV44Y-yRW9q1Bq0bok"
                        style="width: 100%; height: 300px; border: 0;">
                    </iframe>
                </div>

                <!-- Elérhetőségek -->
                <div class="col-md-6 col-12 text-center">
                    <h3>Elérhetőségeink</h3>
                    <p><i class="fa-brands fa-facebook"></i>
                        Facebook - Andi Apartman</a></p>
                    <p><i class="fa fa-map-marker"></i> Balatonszemes, Vörösmarty u. 42</p>
                    <p><i class="fa fa-phone"></i> +06-30/560-1999</p>
                    <p><i class="fa fa-envelope"></i> >andi68andi@gmail.com<< /p>
                </div>
            </div>
        </div>
    </footer>

    <style>

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
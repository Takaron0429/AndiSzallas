<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foglalás</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <script src="{{ asset('foglalasScript.js') }}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://kit.fontawesome.com/be1715d162.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Szállás</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBottom"
                aria-controls="navbarBottom" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarBottom">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="foglalas.html">Foglalás</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="https://szallas.hu/programok/balatonszemes">Program
                            Ajánló</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Carousel -->
    <div id="carouselExampleIndicators" class="carousel slide custom-carousel" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/szemeswide.jpg" class="d-block w-100 carousel-image" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Szállás</h5>
                    <p>udv a szallason blablabla</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/placeholder1.jpg" class="d-block w-100 carousel-image" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Foglalj most!</h5>
                    <p>rizsa</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/placeholder2.jpg" class="d-block w-100 carousel-image" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Valami akció, legfrisebb article-re redirectel (jelenleg nincs))))))</h5>
                    <p>WIP </p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <section class="apartmentStats">
        <div class="container text-center" style="padding-top: 1%;">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <h2>Amit nyújtunk:</h2>
                    <ul>
                        <p class="strongerp"><i class="fa fa-map-marker" style="font-size: 24px;"></i> Balatoni strand
                            600 m
                        </p>
                        <p class="strongerp"><i class="fa fa-map-marker" style="font-size: 24px;"></i> Betonos strand
                            700 m
                        </p>
                        <p class="strongerp"><i class="fa-solid fa-bolt-lightning"></i> Azonnali visszaigazolás</p>
                        <p class="strongerp"><i class="fa-solid fa-square-parking"></i> Ingyenes parkolás</p>
                        <p class="strongerp"><i class="fa-solid fa-droplet"></i> Wellness szolgáltatások</p>
                        <p class="strongerp"><i class="fa-solid fa-snowflake"></i> Légkondicionált helyiség</p>
                        <p class="strongerp"><i class="fa-solid fa-house"></i> 1 apartman, 4 férőhely</p>
                        <p class="strongerp"><i class="fa-solid fa-language"></i> Beszélt nyelvek: Magyar, Német </p>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="img/medencehaz.webp" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/homokozo.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/konyha.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/furdo.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="img/nappali.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container text-center" style="padding-top: 1%;">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <h2>Távolsági helyek az apartmantól:</h2>
                <p class="strongerp">Szántódi Rév</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 30%;" aria-valuenow="30"
                        aria-valuemin="0" aria-valuemax="100">
                        15 km
                    </div>
                </div>
                <p class="strongerp">Siófok</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100">
                        25 km
                    </div>
                </div>
                <p class="strongerp">Balatonboglár bob pálya</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 30%;" aria-valuenow="30"
                        aria-valuemin="0" aria-valuemax="100">
                        15 km
                    </div>
                </div>
                <p class="strongerp">Zamárdi kalandpark</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 36%;" aria-valuenow="36"
                        aria-valuemin="0" aria-valuemax="100">
                        18 km
                    </div>
                </div>
                <p class="strongerp">Keszthely</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100"
                        aria-valuemin="0" aria-valuemax="100">
                        50 km
                    </div>
                </div>
                <p class="strongerp">Hévíz</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100"
                        aria-valuemin="0" aria-valuemax="100">
                        55 km
                    </div>
                </div>
                <p class="strongerp">Csisztapuszta fürdő</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60"
                        aria-valuemin="0" aria-valuemax="100">
                        30 km
                    </div>
                </div>
                <p class="strongerp">Balatonlelle</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100">
                        5,5 km
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">

                <h2>Helyi távolságok az apartmantól:</h2>
                <p class="strongerp">Kistücsök Étterem</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="30"
                        aria-valuemin="0" aria-valuemax="100">
                        1500 m
                    </div>
                </div>
                <p class="strongerp">Élelmiszerüzlet</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="30">
                        360 m
                    </div>
                </div>
                <p class="strongerp">Balaton</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="30"
                        aria-valuemin="0" aria-valuemax="33">
                        500 m
                    </div>
                </div>
                <p class="strongerp">Strand, élményfürdő</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="36"
                        aria-valuemin="0" aria-valuemax="40">
                        600 m
                    </div>
                </div>
                <p class="strongerp">Játszótér</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="100"
                        aria-valuemin="0" aria-valuemax="33">
                        500 m
                    </div>
                </div>
                <p class="strongerp">Hajókikötő</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100"
                        aria-valuemin="0" aria-valuemax="100">
                        1500 m
                    </div>
                </div>
                <p class="strongerp">Vasútállomás</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="60"
                        aria-valuemin="0" aria-valuemax="100">
                        1500 m
                    </div>
                </div>
                <p class="strongerp">Buszmegálló</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100">
                        250 m
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- atmeneti, articlekkel lesz megoldva -->
    <section id="programajanlo" class="mt-5">
        <div class="container">
            <div class="container">
                <div class="row">
                    <h3 style="margin-top: 10px;" class="text-center">Közeli látványosságok</h3>
                    <div class="col-lg-3 col-sm-4 col-6">
                        <a href="https://szallas.hu/programok/zier-bisztro-balatonszemes-p19512" target="_blank"><img
                                src="img/prog/bisztro.jpg" alt=""></a>
                        <h5>Zier Bisztró</h5>
                        <p class="strongerp">300 m</p>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-6">
                        <a href="https://szallas.hu/programok/balatonszemesi-elmenyfurdo-balatonszemes-p123"
                            target="_blank"><img src="img/prog/furdo.jpg" alt=""></a>
                        <h5>Balatonszemesi élményfürdő</h5>
                        <p class="strongerp">700 m</p>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-6">
                        <a href="https://szallas.hu/programok/berzsenyi-utcai-szabadstrand-balatonszemes-p3836"
                            target="_blank"><img src="img/prog/part.jpg" alt=""></a>
                        <h5>Berzsenyi utcai szabadstrand</h5>
                        <p class="strongerp">600 m</p>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-6">
                        <a href="https://szallas.hu/programok/balatonszemes" target="_blank"><img src="img/szemes.webp"
                                class="blurred" alt=""></a>
                        <h5>További látnivalók</h5>
                        <p class="strongerp">Katt</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Meglévő vélemények megjelenítése -->
    <section id="meglevo-velemenyek" class="mt-5">
        <div class="container">
            <h3 class="text-center">Korábbi vélemények</h3>

            <!-- Értékelések átlaga -->
            <div class="text-center mb-4">
                <h4>Átlagos értékelés: {{ isset($atlagErtekeles) ? number_format($atlagErtekeles, 1) : 'N/A' }}/5</h4>
            </div>

            <!-- Vélemények listája -->
            @if(isset($velemenyek) && $velemenyek->count() > 0)
                @foreach($velemenyek as $velemeny)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $velemeny->nev }}</h5>
                            <p class="card-text"><strong>Email:</strong> {{ $velemeny->email }}</p>
                            <p class="card-text"><strong>Értékelés:</strong> {{ $velemeny->ertekeles }}/5</p>
                            <p class="card-text">{{ $velemeny->komment }}</p>
                            <p class="text-muted">{{ $velemeny->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">Nincsenek vélemények.</p>
            @endif
        </div>
    </section>

    <!-- Vélemények űrlapja -->
    <section id="velemenyek" class="mt-5">
        <div class="container">
            <h3 class="text-center">Véleményezés</h3>
            <form action="{{ route('velemeny.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nev">Név:</label>
                    <input type="text" class="form-control" id="nev" name="nev" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="ertekeles">Értékelés (1-5):</label>
                    <select class="form-control" id="ertekeles" name="ertekeles" required>
                        <option value="1">1 - Rossz</option>
                        <option value="2">2 - Elég gyenge</option>
                        <option value="3">3 - Közepes</option>
                        <option value="4">4 - Jó</option>
                        <option value="5">5 - Kiváló</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="komment">Tapasztalataid:</label>
                    <textarea class="form-control" id="komment" name="komment" rows="3"
                        placeholder="Írd le a tapasztalataidat..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Küldés</button>
            </form>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <iframe width="600" height="450" style="border:0" loading="lazy" allowfullscreen
                        src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJcfmOyAexaUcRbfSI-AjnSfA&key=AIzaSyDClC5YHmbvEWO_pWV44Y-yRW9q1Bq0bok"></iframe>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12" id="contact">
                    <h3>Elérhetősegeink:</h3>
                    <p class="strongerp"><i class="fa-brands fa-facebook"></i><a class="linktag"
                            href="https://www.facebook.com/profile.php?id=100057090354050"> Facebook - Andi Apartman</a>
                    </p>
                    <p class="strongerp"><i class="fa fa-map-marker" style="font-size: 24px;"></i> Balatonszemes,
                        Vörösmarty u. 42</p>
                    <p class="strongerp"><i class="fa fa-phone" style="font-size: 24px;"></i> +06305601999</p>
                    <p class="strongerp"><i class="fa fa-envelope" style="font-size: 24px;"></i> andi68andi@gmail.com
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
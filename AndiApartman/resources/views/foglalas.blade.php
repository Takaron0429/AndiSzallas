<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foglalás</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('foglalasStyle.css') }}">


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
            <!-- Toggler gomb mobil nézethez -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Bal oldali linkek -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav me-auto">
                    <a class="nav-link" href="">Kezdőlap</a>
                    <a class="nav-link" href="#meglevo-velemenyek">Vélemények</a>
                    <a class="nav-link" href="foglalas">Foglalás</a>
                </div>
            </div>

            <!-- Jobb oldali elérhetőségek -->
            <div class="navbar-contact-info">
                <span class="contact-item"><i class="fa fa-phone" style="font-size: 24px;"></i> +06-30/560-1999</span>
                <span class="separator">|</span>
                <span class="contact-item"><i class="fa fa-envelope" style="font-size: 24px;"></i>
                    andi68andi@gmail.com</span>
                <span class="separator">|</span>
                <span class="contact-item"><i class="fa fa-map-marker" style="font-size: 24px;"></i> Balatonszemes,
                    Vörösmarty u. 42</span>
                <span class="separator">|</span>
                <a href="https://facebook.com" class="contact-item" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div id="messages-container"></div>
        <form action="{{ route('foglalas.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="booking-calendar" id="booking-calendar"></div>

                    <input type="hidden" id="checkin" name="checkin">
                    <input type="hidden" id="checkout" name="checkout">

                    <div class="selected-dates">
                        <p><strong>Bejelentkezés:</strong> <span id="selected-checkin">-</span></p>
                        <p><strong>Kijelentkezés:</strong> <span id="selected-checkout">-</span></p>
                    </div>
                    <p class="errorParagraph"></p>

                    <p style="display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-person"></i> Felnőtt
                        <select class="form-select" id="felnott" name="felnott">
                            <option selected>0</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </p>

                    <p style="display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-child-reaching"></i> Gyermek (1-12 éves korig)
                        <select class="form-select" id="gyerek" name="gyerek">
                            <option selected>0</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </p>

                    <label for="specialis_keresek">Speciális kérések:</label>
                    <textarea id="specialis_keresek" name="specialis_keresek" rows="4" cols="50"></textarea>
                    <p id="calculatedPrice" class="mt-3"></p>
                    <br><br>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">

                    <!-- ÚJ mezők a vendég adataihoz -->
                    <label><i class="fa-solid fa-address-card"></i> Név:</label>
                    <input type="text" name="nev" required>
                    <br><br>

                    <label><i class="fa-solid fa-envelope"></i> Email:</label>
                    <input type="email" name="email" required>
                    <br><br>

                    <label><i class="fa-solid fa-phone"></i> Telefon:</label>
                    <input type="text" name="telefon">
                    <br><br>

                    <label><i class="fa-solid fa-location-dot"></i> Irányítószám:</label>
                    <input type="text" name="iranyitoszam">
                    <br><br>
                    <label><i class="fa-solid fa-location-dot"></i> Lakcím:</label>
                    <input type="text" name="lakcim">

                    <br><br>
                    <button type="submit">Foglalás elküldése</button>
                </div>
            </div>
        </form>
        </section>
    </div>
    </div>
    </div>

    <footer>
        <!-- Hullámok SVG -->
        <div class="wave-container">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ffffff" fill-opacity="0.2"
                    d="M0,64L48,85.3C96,107,192,149,288,165.3C384,181,480,171,576,138.7C672,107,768,53,864,74.7C960,96,1056,192,1152,234.7C1248,277,1344,267,1392,261.3L1440,256L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
                </path>
            </svg>
        </div>

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
                    <p class="strongerp"><i class="fa fa-phone" style="font-size: 24px;"></i> +06-30/560-1999</p>
                    <p class="strongerp"><i class="fa fa-envelope" style="font-size: 24px;"></i> andi68andi@gmail.com
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>
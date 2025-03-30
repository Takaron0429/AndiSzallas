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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav me-auto">
                    <a class="nav-link" href=""><i class="fa fa-home"></i> Kezdőlap</a>
                    <a class="nav-link" href="#meglevo-velemenyek"><i class="fa fa-comments"></i> Vélemények</a>
                    <a class="nav-link active" href="foglalas"><i class="fa fa-calendar"></i> Foglalás</a>
                </div>

                <div class="navbar-contact-info">
                    <span class="contact-item"><i class="fa fa-phone"></i> +06-30/560-1999</span>
                    <span class="separator">|</span>
                    <span class="contact-item"><i class="fa fa-envelope"></i> andi68andi@gmail.com</span>
                    <span class="separator">|</span>
                    <span class="contact-item"><i class="fa fa-map-marker"></i> Balatonszemes, Vörösmarty u. 42</span>
                    <span class="separator">|</span>
                    <a href="https://facebook.com" class="contact-item">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0"><i class="fa fa-calendar"></i> Foglalás</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('foglalas.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="booking-calendar mb-4" id="booking-calendar"></div>

                            <input type="hidden" id="checkin" name="checkin">
                            <input type="hidden" id="checkout" name="checkout">



                            <div class="selected-dates bg-light p-3 rounded mb-4">
                                <div class="d-flex justify-content-between">
                                    <p class="mb-0"><strong><i class="fa fa-sign-in"></i> Bejelentkezés:</strong> <span
                                            id="selected-checkin" class="fw-bold text-primary">-</span></p>
                                    <p class="mb-0"><strong><i class="fa fa-sign-out"></i> Kijelentkezés:</strong> <span
                                            id="selected-checkout" class="fw-bold text-primary">-</span></p>
                                </div>
                            </div>

                            <p class="errorParagraph alert alert-danger d-none"></p>
                            <div id="messages-container"></div>


                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label"><i class="fa fa-user"></i> Felnőtt</label>
                                    <select class="form-select" id="felnott" name="felnott">
                                        <option selected value="0">0</option>
                                        @for ($i = 1; $i <= 4; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label"><i class="fa fa-child"></i> Gyerek</label>
                                    <select class="form-select" id="gyerek" name="gyerek">
                                        <option selected value="0">0</option>
                                        @for ($i = 1; $i <= 4; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="specialis_keresek" class="form-label"><i class="fa fa-comment"></i>
                                    Speciális kérések:</label>
                                <textarea class="form-control" id="specialis_keresek" name="specialis_keresek"
                                    rows="4"></textarea>
                            </div>

                            <div class="alert alert-info">
                                <h5 class="mb-0" id="calculatedPrice">Válassza ki a dátumot és a vendégek számát az ár
                                    megjelenítéséhez</h5>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-lg-6 col-md-12">
                            <h4 class="mb-4"><i class="fa fa-user-circle"></i> Vendég adatai</h4>

                            <div class="mb-3">
                                <label for="nev" class="form-label"><i class="fa fa-user"></i> Név*</label>
                                <input type="text" class="form-control" id="nev" name="nev" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label"><i class="fa fa-envelope"></i> Email*</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="telefon" class="form-label"><i class="fa fa-phone"></i> Telefon</label>
                                <input type="tel" class="form-control" id="telefon" name="telefon">
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="iranyitoszam" class="form-label"><i class="fa fa-map-pin"></i>
                                        Irányítószám</label>
                                    <input type="text" class="form-control" id="iranyitoszam" name="iranyitoszam">
                                </div>
                                <div class="col-md-8">
                                    <label for="lakcim" class="form-label"><i class="fa fa-map-marker"></i>
                                        Lakcím</label>
                                    <input type="text" class="form-control" id="lakcim" name="lakcim">
                                </div>
                            </div>
                            <!-- Payment Section -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label"><i class="fa fa-credit-card"></i> Fizetési mód*</label>
                                    <div class="payment-options">
                                        <div class="payment-option" id="bank-transfer">
                                            <div class="payment-icon">
                                                <i class="fas fa-money-bill-wave"></i>
                                            </div>
                                            <div class="payment-label">Azonnali utalás</div>
                                        </div>
                                        <div class="payment-option" id="credit-card">
                                            <div class="payment-icon">
                                                <i class="far fa-credit-card"></i>
                                            </div>
                                            <div class="payment-label">Bankkártya</div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="payment-method" name="payment_method" required>
                                </div>
                            </div>

                            <!-- Bank Transfer Details (shown when bank transfer is selected) -->
                            <div id="bank-transfer-details" class="payment-details mb-3 d-none">
                                <div class="alert alert-info">
                                    <h5><i class="fas fa-info-circle"></i> Fizetési utasítások</h5>
                                    <p>Kérjük, utalja a foglalási díj 50%-át (<span id="deposit-amount">0</span> Ft) az
                                        alábbi számlaszámra:</p>
                                    <p><strong>Bankszámlaszám:</strong> 33345678-12345333-00000000</p>
                                    <p><strong>Kedvezményezett:</strong> Andi Apartman Kft.</p>
                                    <p>A maradék összeget a szálláshelyen kell rendeznie.</p>
                                </div>
                            </div>

                            <!-- Credit Card Form (shown when credit card is selected) -->
                            <div id="credit-card-form" class="payment-details mb-3 d-none">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h5><i class="far fa-credit-card"></i> Bankkártya adatai</h5>
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label for="card-number" class="form-label">Kártyaszám*</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="far fa-credit-card"></i></span>
                                                    <input type="text" class="form-control" id="card-number"
                                                        placeholder="1234 5678 9012 3456" maxlength="19">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="card-name" class="form-label">Név a kártyán*</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="far fa-user" id="secretTrigger"></i></span>
                                                    <input type="text" class="form-control" id="card-name"
                                                        placeholder="Benjamin Reichwald">
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="card-expiry" class="form-label">Lejárat*</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="far fa-calendar-alt"></i></span>
                                                    <input type="text" class="form-control" id="card-expiry"
                                                        placeholder="MM/ÉÉ" maxlength="5">
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="card-cvv" class="form-label">CVV*</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                    <input type="password" class="form-control" id="card-cvv"
                                                        placeholder="123" maxlength="3">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <img src="img/simplepay.png"
                                                alt="Secure payment" class="img-fluid" style="max-height: 150px;">
                                            <p class="small text-muted mt-2"><i class="fas fa-lock"></i> Az adatai
                                                biztonságban vannak</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg py-3">
                                    <i class="fa fa-paper-plane"></i> Foglalás elküldése
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div class="wave-container">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ffffff" fill-opacity="0.2"
                    d="M0,64L48,85.3C96,107,192,149,288,165.3C384,181,480,171,576,138.7C672,107,768,53,864,74.7C960,96,1056,192,1152,234.7C1248,277,1344,267,1392,261.3L1440,256L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
                </path>
            </svg>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <iframe width="100%" height="450" style="border:0" loading="lazy" allowfullscreen
                        src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJcfmOyAexaUcRbfSI-AjnSfA&key=AIzaSyDClC5YHmbvEWO_pWV44Y-yRW9q1Bq0bok"></iframe>
                </div>
                <div class="col-lg-6 col-md-12" id="contact">
                    <h3>Elérhetősegeink:</h3>
                    <p class="strongerp"><i class="fab fa-facebook-f"></i><a class="linktag"
                            href="https://www.facebook.com/profile.php?id=100057090354050"> Facebook - Andi Apartman</a>
                    </p>
                    <p class="strongerp"><i class="fa fa-map-marker"></i> Balatonszemes, Vörösmarty u. 42</p>
                    <p class="strongerp"><i class="fa fa-phone"></i> +06-30/560-1999</p>
                    <p class="strongerp"><i class="fa fa-envelope"></i> andi68andi@gmail.com</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
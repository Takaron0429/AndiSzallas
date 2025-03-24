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
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Nunito:wght@300;700&display=swap" rel="stylesheet">
    <title>🌊 Balatoni Programok</title>
    <style>
        body {
            background: linear-gradient(to bottom, #87CEEB, #fdf6e3);
            font-family: 'Nunito', sans-serif;
        }
        .balaton-header {
            background: url('/kepek/balaton-15307.jpg') center/cover;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            padding: 60px 0;
            text-align: center;
        }
        .balaton-header h1 {
            font-family: 'Pacifico', cursive;
            font-size: 3rem;
        }
        .custom-navbar {
            background: #0077b6;
            padding: 15px;
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
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d107840.123456789!2d17.6500000!3d46.8500000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4769c7f7b1b1b1b1%3A0x1b1b1b1b1b1b1b1b!2sBalaton!5e0!3m2!1shu!2shu!4v1610000000000!5m2!1shu!2shu" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- PROGRAMOK KÁRTYÁI -->
    <div class="container my-5">
        @foreach($programok as $helyszin => $lista)
            <h2 class="text-primary mt-4">📍 {{ $helyszin }}</h2>
            <div class="row">
                @foreach($lista as $program)
                    <div class="col-md-4">
                        <div class="card shadow-sm mb-3">
                            <img src="/kepek/balaton-15307.jpg" class="card-img-top" alt="Balatoni program">
                            <div class="card-body">
                                <h5 class="card-title">{{ $program->cim }}</h5>
                                <p class="card-text">{{ Str::limit($program->leiras, 100) }}</p>
                                <p><strong>📅 Dátum: </strong> {{ \Carbon\Carbon::parse($program->datum)->format('Y. m. d.') }}</p>
                                <a href="{{ $program->link }}" class="btn btn-balaton w-100" target="_blank">Részletek</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <script>
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
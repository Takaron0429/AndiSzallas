<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <link rel="stylesheet" href="{{ asset('AdminLogin.css') }}">


    <style>
        html,
        body {

            overflow: auto !important;
            height: auto !important;
        }

        .navbar {
            background-color: rgb(255, 145, 0);

        }

        .navbar-brand {
            font-size: 1.8rem;
            color: #ffffff !important;
            font-weight: 600;
            transition: 0.3s;
        }

        .navbar-brand:hover {
            color: #fff176 !important;
        }

        .nav-link {
            color: #ffffff !important;
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #fff176 !important;
            transform: scale(1.1);
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler-icon {

            border-radius: 5px;
        }

        .widget {
            font-size: 2rem;
            color: #e6bd06;
        }

        .widget-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }


        .mt-4 .card {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .mt-4 .card-header {
            font-size: 1.25rem;
            background-color: rgb(255, 145, 0);
        }

        .mt-4 .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .widget-value {
            font-size: 2rem;
            color: #08c708;
        }

        .booked {
            background-color: #ff4d4d;
            color: white;
            font-weight: bold;
            pointer-events: none;
        }

        .booked td {
            width: 40px;
            height: 40px;
            text-align: center;
            font-weight: bold;
            cursor: pointer;
        }

        .booked .bg-success {
            background-color: green !important;
            color: white !important;
            border-radius: 5px;
        }

        .booked .bg-danger {
            background-color: red !important;
            color: white !important;
            border-radius: 5px;

        }
    </style>
    <title>Admin Főoldal</title>

</head>

<body>


    <div class="container">

        <nav class="container mt-6 navbar navbar-expand-lg navbar-dark ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#foglalas">#Foglalások</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto text-center">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('AdminFelulet.Admin') }}">Admin#Panel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('AdminFelulet.Foglalasok') }}">Foglalások</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('AdminFelulet.Modositasok') }}">Módosítások</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.logout') }}">Kijelentkezés</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @php
            $admin = Auth::user();
        @endphp

        <div class="main-content" id="mainContent">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-sm-12 col-lg-6">
                        <div class="card shadow-lg">
                            <div class="card-body text-center">
                                @foreach([session('admin')] as $admin)
                                    @if($admin)
                                        <div class="card shadow-lg mb-2">
                                            <div class="card-body text-center">
                                                <img src="{{ asset('kepek/boss.png') }}" class="rounded-circle mb-3"
                                                    alt="Admin Avatar" width="120">
                                                <h3 class="card-title text-primary fw-bold">Üdvözlöm,
                                                    {{ $admin['felhasznalonev'] }}!
                                                </h3>
                                                <p class="card-text text-muted">📧 Email: <strong>{{ $admin['email'] }}</strong>
                                                </p>
                                                <p class="card-text text-muted">🕒 Utolsó bejelentkezés:
                                                    <strong>{{ $admin['utolso_bejelentkezes'] ?? 'N/A' }}</strong>
                                                </p>
                                                <p class="badge bg-success p-2">Admin Boss ✅</p>
                                                <p class="badge bg-success p-2">Fő Admin ✅</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <h2>Beérkezett Vélemények</h2>

                @if(isset($velemenyek) && $velemenyek->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Név</th>
                                <th>Email</th>
                                <th>Értékelés</th>
                                <th>Megjegyzés</th>
                                <th>Dátum</th>
                                <th>Jóváhagyás</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($velemenyek as $velemeny)
                                @if($velemeny->status !== 'approved') 
                                    <tr>
                                        <td>{{ $velemeny->nev }}</td>
                                        <td>{{ $velemeny->email }}</td>
                                        <td>{{ $velemeny->ertekeles }}/5</td>
                                        <td>{{ $velemeny->komment }}</td>
                                        <td>{{ $velemeny->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <a href="{{ route('velemeny.approve', ['velemeny_id' => $velemeny->velemeny_id]) }}" class="btn btn-success">Jóváhagyás</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">Nincsenek vélemények.</p>
                @endif
            </div>
            <div class="row">
                <div class="container mt-4">
                    <div class="row">

                        <div class="col-md-4 col-lg-4 col-sm-12 mb-4">
                            <div class="card">
                                <div class="card-header">Új foglalások</div>
                                <div class="card-body">
                                    <i class="fas fa-calendar-check widget"></i>
                                    <div class="widget-value">{{ $ujFoglalasok ?? 'Nincs adat' }}</div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 col-lg-4 col-sm-12 mb-4">
                            <div class="card">
                                <div class="card-header">Időpontok elérhetősége</div>
                                <div class="card-body">
                                    <i class="fas fa-bed widget"></i>
                                    <div class="widget-value">{{ $lefoglaltNapok ?? 'Nincs adat'}} /
                                        {{ $totalDays ?? 0  }}
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 col-lg-4 col-sm-12 mb-4">
                            <div class="card">
                                <div class="card-header">Eddig Befolyt Összeg</div>
                                <div class="card-body">
                                    <i class="fas fa-dollar-sign widget"></i>
                                    <div class="widget-value">{{ $osszegKerekitve ?? 'Nincs adat' }} Ft</div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 col-lg-4 col-sm-12 mb-4">
                            <div class="card">
                                <div class="card-header">Visszajáró vendégek</div>
                                <div class="card-body">
                                    <i class="fas fa-users widget"></i>
                                    <div class="widget-value">{{ $visszajaroVendegSzam ?? 'Nincs adat'}}</div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 col-lg-4 col-sm-12 mb-4">
                            <div class="card">
                                <div class="card-header">További statisztika</div>
                                <div class="card-body">
                                    <div class="widget-value">{{ $visszajaroVendegSzam ?? 'Nincs adat' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12 mb-4">
                            <div class="card">
                                <div class="card-header">További statisztika</div>
                                <div class="card-body">
                                    <div class="widget-value">{{ $visszajaroVendegSzam ?? 'Nincs adat'}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="container mt-4">
                <div class="row">

                    <div class="col-md-3 col-lg-3 col-sm-12">
                        <div class="card">
                            <div class="card-header">Május</div>
                            <div class="card-body">
                                <table id="calendar-may" class="table table-bordered">

                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-lg-3 col-sm-12">
                        <div class="card">
                            <div class="card-header">Június</div>
                            <div class="card-body">
                                <table id="calendar-june" class="table table-bordered">

                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-lg-3 col-sm-12">
                        <div class="card">
                            <div class="card-header">Július</div>
                            <div class="card-body">
                                <table id="calendar-july" class="table table-bordered">

                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-lg-3 col-sm-12">
                        <div class="card">
                            <div class="card-header">Augusztus</div>
                            <div class="card-body">
                                <table id="calendar-august" class="table table-bordered">

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container" id="foglalas">
                <div class="row">
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4 style="font: 700">Aktuális Foglalások</h4>
                        </div>
                        <br>
                        <form method="GET" action="{{ route('AdminFelulet.Admin') }}">
                            <div class="filter-section row mb-4 justify-content-center">
                                <!-- Hónap szűrés -->
                                <div class="col-md-4">
                                    <label for="monthFilter" class="form-label">Hónap</label>
                                    <select class="form-select" name="month" id="monthFilter">
                                        <option value="">Minden hónap</option>
                                        @foreach(range(5, 8) as $month)
                                            <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-4">
                                    <label for="peopleFilter" class="form-label">Emberek száma (Felnőttek +
                                        Gyerekek)</label>
                                    <input type="number" class="form-control" name="people" id="peopleFilter"
                                        placeholder="Összesen (Felnőttek + Gyerekek)" value="{{ request('people') }}">
                                </div>
                            </div>

                            <div class="filter-section row mb-4 justify-content-center">
                                <!-- Legtöbb napot tartó foglalás -->
                                <div class="col-md-4">
                                    <label for="mostDaysFilter" class="form-label">Legtöbb napot tartó foglalás</label>
                                    <select class="form-select" name="most_days" id="mostDaysFilter">
                                        <option value="">Minden foglalás</option>
                                        <option value="1" {{ request('most_days') == '1' ? 'selected' : '' }}>Legtöbb nap
                                        </option>
                                    </select>
                                </div>

                                <!-- Fizetés szűrés -->
                                <div class="col-md-4">
                                    <label for="paymentFilter" class="form-label">Fizetés állapota</label>
                                    <select class="form-select" name="payment_status" id="paymentFilter">
                                        <option value="">Minden fizetés</option>
                                        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>
                                            Kifizetett</option>
                                        <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Függőben lévő</option>
                                    </select>
                                </div>
                            </div>

                            <div class="filter-section row mb-4 justify-content-center">
                                <!-- Email címre vagy telefonszámra keresés -->
                                <div class="col-md-4">
                                    <label for="searchFilter" class="form-label">Keresés Email / Telefonszám</label>
                                    <input type="text" class="form-control" name="search" id="searchFilter"
                                        placeholder="Email vagy Telefonszám" value="{{ request('search') }}">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Szűrés</button>
                            </div>
                        </form>
                        <br>
                        <div class="card-body col-sm-12">
                            <table class="table table-striped table-hover">
                                <thead class="col-12">
                                    <tr>
                                        <th>Foglalas</th>
                                        <th>Azonositó</th>
                                        <th>Név</th>
                                        <th>Email</th>
                                        <th>Foglalás dátuma</th>
                                        <th>Állapot</th>
                                        <th>Részletek</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Foglalas as $foglalas)
                                        @if (date('Y', strtotime($foglalas->erkezes)) == 2025)
                                            <tr class="col-12">
                                                <td>{{ $foglalas->vendeg_id }}</td>
                                                <td>{{ $foglalas->foglalas_id }}</td>
                                                <td>{{ $foglalas->vendeg->nev ?? 'Nincs név' }}</td>
                                                <td>{{ $foglalas->vendeg->email ?? 'Nincs email' }}</td>
                                                <td>{{ $foglalas->erkezes }}</td>
                                                <td>{{ $foglalas->foglalas_allapot }}</td>
                                                <td>
                                                    <button class="btn btn-info" data-bs-toggle="modal"
                                                        data-bs-target="#bookingModal{{ $foglalas->foglalas_id }}">
                                                        Részletek
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            @foreach ($Foglalas as $foglalas)
                @if (date('Y', strtotime($foglalas->erkezes)) == 2025)
                    <div class="modal fade" id="bookingModal{{ $foglalas->foglalas_id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Foglalás Kezelése</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <ul class="nav nav-tabs" id="foglalasTab{{ $foglalas->foglalas_id }}">
                                        <li class="nav-item">
                                            <button class="nav-link active" style="background-color: aqua; color: white;"
                                                data-bs-toggle="tab"
                                                data-bs-target="#reszletek-{{ $foglalas->foglalas_id }}">Részletek</button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link" style="background-color: gold ; color: white"
                                                data-bs-toggle="tab"
                                                data-bs-target="#modositas-{{ $foglalas->foglalas_id }}">Módosítás</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content mt-3">

                                        <div class="tab-pane fade show active" id="reszletek-{{ $foglalas->foglalas_id }}">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p><strong>Név:</strong> {{ $foglalas->vendeg->nev ?? 'Nincs név' }}</p>
                                                    <p><strong>Érkezés:</strong> {{ $foglalas->erkezes }}</p>
                                                    <p><strong>Távozás:</strong> {{ $foglalas->tavozas }}</p>
                                                    <p><strong>Felnőttek:</strong> {{ $foglalas->felnott }}</p>
                                                    <p><strong>Gyerekek:</strong> {{ $foglalas->gyerek }}</p>
                                                    <p><strong>Csomagok:</strong>
                                                        @if ($foglalas->csomagok->isNotEmpty())
                                                            @foreach ($foglalas->csomagok as $csomag)
                                                                {{ $csomag->nev }} ({{ $csomag->ar }} Ft)<br>
                                                            @endforeach
                                                        @else
                                                            Nincs csomag
                                                        @endif
                                                    </p>

                                                    <p><strong>Akciók:</strong>
                                                        @if ($foglalas->akciok->isNotEmpty())
                                                            @foreach ($foglalas->akciok as $akcio)
                                                                {{ $akcio->cim }} ({{ $akcio->kedvezmeny_szazalek }}% kedvezmény)<br>
                                                            @endforeach
                                                        @else
                                                            Nincs akció
                                                        @endif
                                                    </p>
                                                    <p><strong>Végső összeg:</strong>
                                                        <span
                                                            id="osszegMegjelenit{{ $foglalas->foglalas_id }}">{{ $foglalas->osszeg }}</span>
                                                        Ft
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="modositas-{{ $foglalas->foglalas_id }}">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form
                                                        action="{{ route('AdminFelulet.FoglalasUpdate', $foglalas->foglalas_id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <input type="hidden" id="csomagAr{{ $foglalas->foglalas_id }}"
                                                            value="{{ $foglalas->csomag->ar ?? 0 }}">
                                                        <input type="hidden" id="akcioSzazalek{{ $foglalas->foglalas_id }}"
                                                            value="{{ $foglalas->akcio->kedvezmeny_szazalek ?? 0 }}">

                                                        <div class="mb-3">
                                                            <label class="form-label">Érkezés dátuma</label>
                                                            <input type="date" class="form-control foglalas-input"
                                                                name="erkezes" id="erkezes{{ $foglalas->foglalas_id }}"
                                                                value="{{ $foglalas->erkezes }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Távozás dátuma</label>
                                                            <input type="date" class="form-control foglalas-input"
                                                                name="tavozas" id="tavozas{{ $foglalas->foglalas_id }}"
                                                                value="{{ $foglalas->tavozas }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Felnőttek száma</label>
                                                            <input type="number" class="form-control foglalas-input"
                                                                name="felnott" id="felnott{{ $foglalas->foglalas_id }}"
                                                                value="{{ $foglalas->felnott }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Gyerekek száma</label>
                                                            <input type="number" class="form-control foglalas-input"
                                                                name="gyerek" id="gyerek{{ $foglalas->foglalas_id }}"
                                                                value="{{ $foglalas->gyerek }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Csomag</label>
                                                            <select name="csomag_id" class="form-control">
                                                                @foreach ($csomagok as $csomag)
                                                                    <option value="{{ $csomag->csomag_id }}" {{ $csomag->csomag_id == $foglalas->csomag_id ? 'selected' : '' }}> {{ $csomag->nev }} ({{ $csomag->ar }} Ft)
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Akció</label>
                                                            <select name="akcio_id" class="form-control">
                                                                <option value="">Nincs akció</option>
                                                                @foreach ($akciok as $akcio)
                                                                    <option value="{{ $akcio->akcio_id }}" {{ $akcio->akcio_id == $foglalas->akcio_id ? 'selected' : '' }}>
                                                                        {{ $akcio->cim }} ({{ $akcio->kedvezmeny_szazalek }}%
                                                                        kedvezmény)
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Újraszámolt összeg</label>
                                                            <input type="text" class="form-control"
                                                                id="ujOsszeg{{ $foglalas->foglalas_id }}" name="osszeg"
                                                                value="{{ $foglalas->osszeg }}" readonly>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Mégse</button>
                                                            <button type="submit" class="btn btn-primary">Frissítés</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            <br>
            <hr>
            <h2 class="text-center">Statisztika</h2>
            <hr>
            <br>
            <a href="{{ route('admin.login') }}" class="btn btn-danger w-100">Kijelentkezés</a>

            <div class="footer">
                <p class="text-left">&copy; 2025 Admin Felület | Minden jog fenntartva | Készitette Takács Áron</p>
            </div>
        </div>




    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            var foglaltNapok = [
                "2025-05-10", "2025-05-11", "2025-05-12", "2025-05-13", "2025-05-14", "2025-05-15",
                "2025-06-01", "2025-06-02", "2025-06-03", "2025-06-04", "2025-06-05", "2025-06-06", "2025-06-07",
                "2025-07-01", "2025-07-02", "2025-07-03", "2025-07-04", "2025-07-05", "2025-07-06",
                "2025-08-01", "2025-08-02", "2025-08-03", "2025-08-04"
            ];

            function isBooked(dateStr) {
                return foglaltNapok.includes(dateStr);
            }


            function generateCalendar(tableId, year, month) {
                var table = document.getElementById(tableId);
                var firstDay = new Date(year, month, 1).getDay();
                var daysInMonth = new Date(year, month + 1, 0).getDate();

                var html = `
        <thead>
            <tr>
                <th>H</th>
                <th>K</th>
                <th>Sze</th>
                <th>Cs</th>
                <th>P</th>
                <th>Szo</th>
                <th>V</th>
            </tr>
        </thead>
        <tbody>
        <tr>`;


                for (var i = 0; i < firstDay; i++) {
                    html += "<td></td>";
                }


                for (var i = 1; i <= daysInMonth; i++) {
                    var currentDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
                    var isFoglalt = isBooked(currentDate);
                    var cellClass = isFoglalt ? 'bg-danger text-white' : 'bg-success text-white';

                    html += `<td class="${cellClass}">${i}</td>`;
                    if ((firstDay + i - 1) % 7 === 6) {
                        html += "</tr><tr>";
                    }
                }

                html += "</tr></tbody>";
                table.innerHTML = html;
            }


            generateCalendar("calendar-may", 2025, 5);
            generateCalendar("calendar-june", 2025, 6);
            generateCalendar("calendar-july", 2025, 7);
            generateCalendar("calendar-august", 2025, 8);
        });
    </script>
</body>

</html>
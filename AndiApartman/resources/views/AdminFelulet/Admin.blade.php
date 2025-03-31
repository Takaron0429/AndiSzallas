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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .notification-container {
        cursor: pointer;
        padding: 10px;
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        border-radius: 5px;
        display: inline-block;
        font-weight: bold;
        text-align: center;
        width: 100%;
        max-width: 400px;
        margin: 10px auto;
    }

    .notification-badge {
        background-color: #dc3545;
        color: white;
        padding: 3px 8px;
        border-radius: 50%;
        font-size: 14px;
        margin-left: 5px;
    }

    /* Reszponzivitás */
    @media (max-width: 768px) {
        .notification-container {
            display: block;
            text-align: center;
        }
    }

    /* Accordion stílus */
    .accordion {
        margin-top: 15px;
    }

    .accordion-item {
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .accordion-button {
        background-color: #f1f1f1;
        font-weight: bold;
        text-transform: uppercase;
    }

    .table {
        margin-bottom: 0;
    }

    .btn {
        margin: 5px;
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

            <div class="notification-container" onclick="toggleVelemenyek()">
                @if(isset($velemenyek))
                    @php
                        $notApprovedVelemenyek = $velemenyek->where('approved', 0)->count();
                    @endphp
                    @if($notApprovedVelemenyek > 0)
                        Nem jóváhagyott vélemények: <span class="notification-badge">{{ $notApprovedVelemenyek }}</span>
                    @else
                        Nincs függőben lévő vélemény
                    @endif
                @endif
            </div>
            
           
            <div id="velemenyContainer" class="hidden">
                <div class="accordion" id="velemenyAccordion">
                    <h4 style="font-weight: bolder; text-align: center;">Bejövő Értékelések</h4>
                    @foreach($velemenyek as $velemeny)
                        @if(!$velemeny->approved)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $velemeny->velemeny_id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $velemeny->velemeny_id }}" aria-expanded="false"
                                        aria-controls="collapse{{ $velemeny->velemeny_id }}">
                                        <strong>{{ $velemeny->nev }}</strong> - {{ $velemeny->ertekeles }}/10
                                    </button>
                                </h2>
                                <div id="collapse{{ $velemeny->velemeny_id }}" class="accordion-collapse collapse"
                                    aria-labelledby="heading{{ $velemeny->velemeny_id }}" data-bs-parent="#velemenyAccordion">
                                    <div class="accordion-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $velemeny->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Komment</th>
                                                <td>{{ $velemeny->komment }}</td>
                                            </tr>
                                            <tr>
                                                <th>Értékelés</th>
                                                <td>{{ $velemeny->ertekeles }}</td>
                                            </tr>
                                            <tr>
                                                <th>Dátum</th>
                                                <td>{{ $velemeny->created_at->format('Y-m-d H:i') }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    <a href="{{ route('velemeny.approve', $velemeny->velemeny_id) }}"
                                                        class="btn btn-success">
                                                        <i class="fas fa-check"></i> Jóváhagyás
                                                    </a>
                                                    <a href="{{ route('velemeny.delete', ['email' => $velemeny->email]) }}"
                                                        class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i> Törlés
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            
            <script>
                function toggleVelemenyek() {
                    var container = document.getElementById("velemenyContainer");
                    container.classList.toggle("hidden");
                }
            </script>
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
                                    <div class="widget-value">{{ $lefoglaltNapok ?? 'Nincs adat' }} / {{ $totalDays ?? 0 }}</div>
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
                                    <div class="widget-value">{{ $visszajaroVendegSzam ?? 8 }}</div>
                                </div>
                            </div>
                        </div>
            
                        
                        <div class="col-md-4 col-lg-4 col-sm-12 mb-4">
                            <div class="card">
                                <div class="card-header">Legnépszerűbb Akció</div>
                                <div class="card-body">
                                    <i class="fas fa-tags widget"></i>
                                    <div class="widget-value">{{ $legnepszerubbAkcioNeve ?? 'Nincs adat' }}</div>
                                </div>
                            </div>
                        </div>
            
                       
                        <div class="col-md-4 col-lg-4 col-sm-12 mb-4">
                            <div class="card">
                                <div class="card-header">Legnépszerűbb Csomag</div>
                                <div class="card-body">
                                    <i class="fas fa-box widget"></i>
                                   <div class="widget-value">{{ $legnepszerubbCsomagNeve ?? 'Nincs adat' }}</div>
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
                                <div class="col-md-4">
                                    <label for="monthFilter" class="form-label">Hónap</label>
                                    <select class="form-select" name="month" id="monthFilter">
                                        <option value="">Minden hónap</option>
                                        @foreach(range(5, 8) as $month)
                                            <option value="{{ $month }}" 
                                                {{ request('month') == $month ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="peopleFilter" class="form-label">Emberek száma (Felnőttek + Gyerekek)</label>
                                    <input type="number" class="form-control" name="people" id="peopleFilter" 
                                        placeholder="Összesen (Felnőttek + Gyerekek)" value="{{ request('people') }}">
                                </div>
                            </div>
                            <div class="filter-section row mb-4 justify-content-center">
                                <div class="col-md-4">
                                    <label for="sortFilter" class="form-label">Rendezés</label>
                                    <select class="form-select" name="sort_by" id="sortFilter">
                                        <option value="">Nincs rendezés</option>
                                        <option value="most_days" {{ request('sort_by') == 'most_days' ? 'selected' : '' }}>Legtöbb nap</option>
                                        <option value="most_payment" {{ request('sort_by') == 'most_payment' ? 'selected' : '' }}>Legtöbb fizetés</option>
                                        <option value="most_people" {{ request('sort_by') == 'most_people' ? 'selected' : '' }}>Legtöbb ember</option>
                                    </select>
                                </div>
                            
                                <div class="col-md-4">
                                    <label for="paymentFilter" class="form-label">Foglalás állapota</label>
                                    <select class="form-select" name="payment_status" id="paymentFilter">
                                        <option value="">Minden foglalás</option>
                                        <option value="elfogadva" {{ request('payment_status') == 'elfogadva' ? 'selected' : '' }}>Elfogadott</option>
                                        <option value="függőben" {{ request('payment_status') == 'függőben' ? 'selected' : '' }}>Függőben lévő</option>
                                        <option value="elutasitva'" {{ request('payment_status') == 'elutasitva' ? 'selected' : '' }}>Elutasított</option>
                                    </select>
                                </div>
                            </div>
                            <div class="filter-section row mb-4 justify-content-center">
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
                                        <th>Foglalás</th>
                                        <th>Azonositó</th>
                                        <th>Név</th>
                                        <th>Email</th>
                                        <th>Telefonszám</th>
                                        <th>Összeg</th>
                                        <th>Érkezés dátuma</th>
                                        <th>Állapot</th>
                                        <th>Részletek</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($foglalasok as $foglalas)
                                        @if (date('Y', strtotime($foglalas->erkezes)) == 2025)
                                            <tr class="col-12">
                                                <td>{{ $foglalas->vendeg_id }}</td>
                                                <td>{{ $foglalas->foglalas_id }}</td>
                                                <td>{{ $foglalas->vendeg->nev ?? 'Nincs név' }}</td>
                                                <td>{{ $foglalas->vendeg->email ?? 'Nincs email' }}</td>
                                                <td>+{{ $foglalas->vendeg->telefon ?? 'Nincs telefon' }}</td>
                                                <td>{{ $foglalas->osszeg }} Ft</td>
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
            
            @foreach ($foglalasok as $foglalas)
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
                                                data-bs-toggle="tab" data-bs-target="#reszletek-{{ $foglalas->foglalas_id }}">Részletek</button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link" style="background-color: gold ; color: white"
                                                data-bs-toggle="tab" data-bs-target="#modositas-{{ $foglalas->foglalas_id }}">Módosítás</button>
                                        </li>
                                    </ul>
            
                                    <div class="tab-content mt-3">
                                        <div class="tab-pane fade show active" id="reszletek-{{ $foglalas->foglalas_id }}">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p><strong>Foglalás Dátuma:</strong> {{ $foglalas->created_at ?? 'Nincs megadva (teszt)'}}</p>
                                                    <p><strong>Név:</strong> {{ $foglalas->vendeg->nev ?? 'Nincs név' }}</p>
                                                    <p><strong>Email:</strong> {{ $foglalas->vendeg->email ?? 'Nincs email' }}</p>
                                                    <p><strong>Telefonszám:</strong> {{ $foglalas->vendeg->telefon ?? 'Nincs telefonszám' }} </p>
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
                                                        <span id="osszegMegjelenit{{ $foglalas->foglalas_id }}">{{ $foglalas->osszeg }}</span>
                                                        Ft
                                                    </p>
                                                    <p><strong>Foglalás állapota:</strong> {{ $foglalas->foglalas_allapot }}</p>
                                                    <p><strong>Fizetés állapota:</strong> {{ $foglalas->fizetes_allapot }}</p>
                                                    <p><strong>Speciális kérések:</strong> {{ $foglalas->speciális_keresek ?? 'Nincsenek' }}</p>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="tab-pane fade" id="modositas-{{ $foglalas->foglalas_id }}">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="{{ route('AdminFelulet.FoglalasUpdate', $foglalas->foglalas_id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label class="form-label">Foglalás állapota</label>
                                                            <select name="foglalas_allapot" class="form-control">
                                                                <option value="függőben" {{ $foglalas->foglalas_allapot == 'függőben' ? 'selected' : '' }}>Függőben</option>
                                                                <option value="elfogadva" {{ $foglalas->foglalas_allapot == 'elfogadva' ? 'selected' : '' }}>Elfogadva</option>
                                                                <option value="elutasitva" {{ $foglalas->foglalas_allapot == 'elutasitva' ? 'selected' : '' }}>Elutasitva</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Fizetés állapota</label>
                                                            <select name="fizetes_allapot" class="form-control">
                                                                <option value="függőben" {{ $foglalas->fizetes_allapot == 'függőben' ? 'selected' : '' }}>Függőben</option>
                                                                <option value="kifizetett" {{ $foglalas->fizetes_allapot == 'kifizetett' ? 'selected' : '' }}>Kifizetett</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Speciális kérések</label>
                                                            <textarea class="form-control" name="speciális_keresek" rows="3">{{ $foglalas->speciális_keresek }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Érkezés dátuma</label>
                                                            <input type="date" class="form-control foglalas-input" name="erkezes"
                                                                id="erkezes{{ $foglalas->foglalas_id }}" value="{{ $foglalas->erkezes }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Távozás dátuma</label>
                                                            <input type="date" class="form-control foglalas-input" name="tavozas"
                                                                id="tavozas{{ $foglalas->foglalas_id }}" value="{{ $foglalas->tavozas }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Felnőttek száma</label>
                                                            <input type="number" class="form-control foglalas-input" name="felnott"
                                                                id="felnott{{ $foglalas->foglalas_id }}" value="{{ $foglalas->felnott }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Gyerekek száma</label>
                                                            <input type="number" class="form-control foglalas-input" name="gyerek" id="gyerek{{ $foglalas->foglalas_id }}" value="{{ $foglalas->gyerek }}" required></div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Csomag</label>
                                                            <select name="csomag_id" class="form-control">
                                                                @foreach ($csomagok as $csomag)
                                                                <option value="{{ $csomag->csomag_id }}" {{ $csomag->csomag_id == $foglalas->csomag_id ? 'selected' : '' }}> {{ $csomag->nev }} ({{ $csomag->ar }} Ft)
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    
                                                        <!-- Akciók -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Akció</label>
                                                            <select name="akcio_id" class="form-control">
                                                                <option value="">Nincs akció</option>
                                                                @foreach ($akciok as $akcio)
                                                                    <option value="{{ $akcio->akcio_id }}" {{ $akcio->akcio_id == $foglalas->akcio_id ? 'selected' : '' }}>{{ $akcio->cim }} ({{ $akcio->kedvezmeny_szazalek }}% kedvezmény)  </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    
                                                        <!-- Újraszámolt összeg -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Újraszámolt összeg</label>
                                                            <input type="text" class="form-control" id="ujOsszeg{{ $foglalas->foglalas_id }}" name="osszeg" value="{{ $foglalas->osszeg }}" readonly>
                                                        </div>
                                                    
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégse</button>
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
            <style>
                .Dia {
    background-color: #fff; /* Fehér háttér */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
}

/* Címek stílusa */
.Dia h2, .Dia h4 {
    text-align: center;
    color: #007bff; /* Kék szín */
    font-weight: bold;
}

/* Kártya stílus a diagramokhoz */
.Dia canvas {
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    width: 100% !important;
    height: auto !important;
}

/* Távolság az elemek között */
.Dia .row {
    margin-top: 20px;
}

/* Gombok csak a Dia div-en belül */
.Dia button {
    background: #007bff;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    transition: 0.3s;
}

.Dia button:hover {
    background: #0056b3;
}

/* Mobilbarát dizájn */
@media (max-width: 768px) {
    .Dia {
        padding: 10px;
    }

    .Dia h2, .Dia h4 {
        font-size: 18px;
    }
}
            </style>
          <div class="Dia">
            <br>
            <hr>
            <h2 class="text-center">Idei Foglalási Statisztika </h2>
            <hr>
            <br>
            <div class="container mt-4">
                
                <div class="row">
                  
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <h4 class="text-center">Foglalások - Havi bontásban </h4>
                        <canvas id="foglalasokChart"></canvas>
                        <br>
                        <h4 class="text-center">Összesen: {{ $ujFoglalasok ?? 'Nincs adat' }}</h4>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <h4 class="text-center">Foglalások Összeg Havi bontásban</h4>
                        <canvas id="foglalasokOsszegChart"></canvas>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-12">
                        <h4 class="text-center">Vendégek száma (Havi bontásban)</h4>
                        <canvas id="vendegSzamChart"></canvas>
                    </div>
                    @php
   
                          $legjobbFoglalas = null;
                        $maxOsszeg = 0;
                      foreach ($foglalasok as $foglalas) {
                      if ($foglalas->osszeg > $maxOsszeg) {
                          $maxOsszeg = $foglalas->osszeg;
                         $legjobbFoglalas = $foglalas;
                         }
                      }
                    @endphp
                 <div class="col-md-4 col-lg-4 col-sm-12">
                    <h4 class="text-center">Legjövedelmezőbb Foglalás a Szezonban (2025)</h4>
                    
                    @if($legjobbFoglalas)
                        <div>

                            <h5 class="text-center">{{ $legjobbFoglalas->vendeg->nev ?? 'Nincs adat' }}</h5>
                            <h6 class="text-center">
                                Hónap: 
                                {{ 
                                    \Carbon\Carbon::parse($legjobbFoglalas->erkezes)->format('F') 
                                }}
                            </h6>
            
                            <p class="text-center">
                                Érkezés: {{ \Carbon\Carbon::parse($legjobbFoglalas->erkezes)->format('Y-m-d') ?? 'Nincs adat' }}
                            </p>
                            <p class="text-center">
                                Távozás: {{ \Carbon\Carbon::parse($legjobbFoglalas->tavozas)->format('Y-m-d') ?? 'Nincs adat' }}
                            </p>
                
                            @php
                                $erkezes = \Carbon\Carbon::parse($legjobbFoglalas->erkezes);
                                $tavozas = \Carbon\Carbon::parse($legjobbFoglalas->tavozas);
                                $tartozkodas = $tavozas->diffInDays($erkezes); // Különbség napokban
                            @endphp
                            <p class="text-center">
                                Tartózkodás ideje: 
                                {{ isset($tartozkodas) && $tartozkodas > 0 ? $tartozkodas : '7' }} nap
                            </p>
                
                            <!-- Összeg formázása -->
                            <h3 class="text-center text-success">
                                {{ number_format($legjobbFoglalas->osszeg, 0, ',', ' ') }} Ft
                            </h3>
                        </div>
                    @else
                        <p class="text-center">Nincs adat a legjobb foglalásról.</p>
                    @endif
                </div>
                    <div class="col-md-4 col-lg-4 col-sm-12">
                        <h4 class="text-center">Foglalások Átlagos Hossza (napok)</h4>
                        <canvas id="foglalasHosszChart"></canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <h4 class="text-center">Csomagok Összesen</h4>
                        <canvas id="csomagokChart"></canvas>
                    </div>
                    
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <h4 class="text-center">Akciók Összesen</h4>
                        <canvas id="akciokChart"></canvas>
                    </div>
                </div>
              
            </div>
          </div>
            
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
           
            <script>
             var ctxVendegSzam = document.getElementById('vendegSzamChart').getContext('2d');
             var vendegSzamChart = new Chart(ctxVendegSzam, {
             type: 'line', 
             data: {
            labels: [
                @foreach($vendegSzam as $data)
                    '{{ $data->honap }}' @if(!$loop->last), @endif
                @endforeach
            ],
            datasets: [{
                    label: 'Gyerekek száma',
                    data: [
                        @foreach($vendegSzam as $data)
                            {{ $data->gyerek }} @if(!$loop->last), @endif
                        @endforeach
                    ],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                },
                {
                    label: 'Felnőttek száma',
                    data: [
                        @foreach($vendegSzam as $data)
                            {{ $data->felnott }} @if(!$loop->last), @endif
                        @endforeach
                    ],
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value; 
                        }
                    }
                }
            }
        }
    });
    
    var ctxFoglalasHossz = document.getElementById('foglalasHosszChart').getContext('2d');
    var foglalasHosszChart = new Chart(ctxFoglalasHossz, {
        type: 'bar',
        data: {
            labels: [
                @foreach($atlagosHossz as $data)
                    '{{ $data->honap }}' @if(!$loop->last), @endif
                @endforeach
            ],
            datasets: [{
                label: 'Átlagos Foglalási Hossz (napok)',
                data: [
                    @foreach($atlagosHossz as $data)
                        {{ $data->atlag_hossz }} @if(!$loop->last), @endif
                    @endforeach
                ],
                backgroundColor: 'rgba(255, 159, 64, 0.5)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    var ctxFoglalasokOsszeg = document.getElementById('foglalasokOsszegChart').getContext('2d');
    var foglalasokOsszegChart = new Chart(ctxFoglalasokOsszeg, {
        type: 'line',
        data: {
            labels: [
                @foreach($foglalasokOsszegHavonta as $adat)
                    '{{ $adat->honap }}' @if(!$loop->last), @endif
                @endforeach
            ],
            datasets: [{
                label: 'Foglalások összege (Ft)',
                data: [
                    @foreach($foglalasokOsszegHavonta as $adat)
                        {{ $adat->havi_osszeg }} @if(!$loop->last), @endif
                    @endforeach
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
                // Foglalások havi bontásban (oszlopdiagram)
                var ctxFoglalasok = document.getElementById('foglalasokChart').getContext('2d');
                var foglalasokChart = new Chart(ctxFoglalasok, {
                    type: 'bar',
                    data: {
                        labels: [ 'Május', 'Június', 'Július', 'Augusztus'],
                        datasets: [{
                            label: 'Foglalások száma',
                            data: [
                                @foreach($foglalasokHavonta as $foglalas)
                                    {{ $foglalas->foglalasok_szama }}@if(!$loop->last),@endif
                                @endforeach
                            ],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            
                // Csomagok kördiagram
                var ctxCsomagok = document.getElementById('csomagokChart').getContext('2d');
                var csomagokChart = new Chart(ctxCsomagok, {
                    type: 'pie',
                    data: {
                        labels: [
                            @foreach($csomagokST as $csomag)
                                '{{ $csomag->nev }}' @if(!$loop->last), @endif
                            @endforeach
                        ],
                        datasets: [{
                            label: 'Csomagok népszerűsége',
                            data: [
                                @foreach($csomagokST as $csomag)
                                    {{ $csomag->foglalasok_szama }}@if(!$loop->last), @endif
                                @endforeach
                            ],
                            backgroundColor: ['rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(255, 159, 64, 0.5)', 'rgba(255, 99, 132, 0.5)'],
                            borderColor: ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 99, 132, 1)'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw + ' foglalás';
                                    }
                                }
                            }
                        }
                    }
                });
            
                // Akciók kördiagram
                var ctxAkciok = document.getElementById('akciokChart').getContext('2d');
                var akciokChart = new Chart(ctxAkciok, {
                    type: 'pie',
                    data: {
                        labels: [
                            @foreach($akciokST as $akcio)
                                '{{ $akcio->cim }}' @if(!$loop->last), @endif
                            @endforeach
                        ],
                        datasets: [{
                            label: 'Akciók népszerűsége',
                            data: [
                                @foreach($akciokST as $akcio)
                                    {{ $akcio->foglalasok_szama }}@if(!$loop->last), @endif
                                @endforeach
                            ],
                            backgroundColor: ['rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(255, 159, 64, 0.5)', 'rgba(255, 99, 132, 0.5)'],
                            borderColor: ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)', 'rgba(255, 99, 132, 1)'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw + ' foglalás';
                                    }
                                }
                            }
                        }
                    }
                });
            </script>
           
             <br>
            <a href="{{ route('admin.login') }}" class="btn btn-danger w-100">Kijelentkezés</a>

            <div class="footer">
                <p class="text-left">&copy; 2025 Admin Felület | Minden jog fenntartva | Készitette Takács Áron</p>
            </div>
        </div>




    </div>

    <script src="{{asset('AdminALL.js')}}"> </script>
</body>

</html>
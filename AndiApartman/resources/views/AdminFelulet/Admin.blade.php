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
                                                    <p><strong>Telefonszám:</strong> {{ $foglalas->vendeg->telefon ?? 'Nincs telefonszám' }}</p>
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
                                                    
                                                        <!-- Fizetés állapota -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Fizetés állapota</label>
                                                            <select name="fizetes_allapot" class="form-control">
                                                                <option value="függőben" {{ $foglalas->fizetes_allapot == 'függőben' ? 'selected' : '' }}>Függőben</option>
                                                                <option value="kifizetett" {{ $foglalas->fizetes_allapot == 'kifizetett' ? 'selected' : '' }}>Kifizetett</option>
                                                            </select>
                                                        </div>
                                                    
                                                        <!-- Speciális kérések -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Speciális kérések</label>
                                                            <textarea class="form-control" name="speciális_keresek" rows="3">{{ $foglalas->speciális_keresek }}</textarea>
                                                        </div>
                                                    
                                                        <!-- Érkezés dátuma -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Érkezés dátuma</label>
                                                            <input type="date" class="form-control foglalas-input" name="erkezes"
                                                                id="erkezes{{ $foglalas->foglalas_id }}" value="{{ $foglalas->erkezes }}" required>
                                                        </div>
                                                    
                                                        <!-- Távozás dátuma -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Távozás dátuma</label>
                                                            <input type="date" class="form-control foglalas-input" name="tavozas"
                                                                id="tavozas{{ $foglalas->foglalas_id }}" value="{{ $foglalas->tavozas }}" required>
                                                        </div>
                                                    
                                                        <!-- Felnőttek száma -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Felnőttek száma</label>
                                                            <input type="number" class="form-control foglalas-input" name="felnott"
                                                                id="felnott{{ $foglalas->foglalas_id }}" value="{{ $foglalas->felnott }}" required>
                                                        </div>
                                                    
                                                        <!-- Gyerekek száma -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Gyerekek száma</label>
                                                            <input type="number" class="form-control foglalas-input" name="gyerek"
                                                                id="gyerek{{ $foglalas->foglalas_id }}" value="{{ $foglalas->gyerek }}" required>
                                                        </div>
                                                    
                                                        <!-- Csomagok -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Csomag</label>
                                                            <select name="csomag_id" class="form-control">
                                                                @foreach ($csomagok as $csomag)
                                                                    <option value="{{ $csomag->csomag_id }}" {{ $csomag->csomag_id == $foglalas->csomag_id ? 'selected' : '' }}> 
                                                                        {{ $csomag->nev }} ({{ $csomag->ar }} Ft)
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
                                                                    <option value="{{ $akcio->akcio_id }}" {{ $akcio->akcio_id == $foglalas->akcio_id ? 'selected' : '' }}>
                                                                        {{ $akcio->cim }} ({{ $akcio->kedvezmeny_szazalek }}% kedvezmény)
                                                                    </option>
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
    var foglaltNapok = [];
    var erkezesNapok = [
    "2025-05-01", "2025-05-05", "2025-05-10", "2025-05-15", "2025-05-20", "2025-05-25",
    "2025-06-01", "2025-06-05", "2025-06-10", "2025-06-15", "2025-06-20", "2025-06-25",
    "2025-07-01", "2025-07-05", "2025-07-10", "2025-07-15", "2025-07-20", "2025-07-25",
    "2025-08-01", "2025-08-05", "2025-08-10", "2025-08-15", "2025-08-20"
];


    fetch('/admin/foglalt-napok') 
        .then(response => response.json())
        .then(data => {
            foglaltNapok = data; 
            generateCalendar("calendar-may", 2025, 4);  
            generateCalendar("calendar-june", 2025, 5); 
            generateCalendar("calendar-july", 2025, 6); 
            generateCalendar("calendar-august", 2025, 7); 
        });

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
            var isFoglalt = foglaltNapok.includes(currentDate); 
            var isErkezes = erkezesNapok.includes(currentDate); 

           
            var cellClass = '';
            if (isErkezes) {
                cellClass = 'bg-warning text-white'; 
            } else if (isFoglalt) {
                cellClass = 'bg-danger text-white'; 
            } else {
                cellClass = 'bg-success text-white'; 
            }

            html += `<td class="${cellClass}">${i}</td>`;
            if ((firstDay + i - 1) % 7 === 6) {
                html += "</tr><tr>";
            }
        }

        html += "</tr></tbody>";
        table.innerHTML = html;
    }
    });

    </script>
</body>

</html>
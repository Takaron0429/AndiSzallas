<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Foglalások</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fdf2e9;
            padding-top: 80px;
        }

        header {
            background: linear-gradient(90deg, rgba(255, 165, 0, 0.8), rgba(255, 99, 71, 0.8));
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
        }

        header h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .container {
            max-width: 1200px;
        }

        /* Navbar stílusok */
        .navbar {
            background-color: #ff5722;
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


        .footer {
            background-color: rgb(255, 145, 0);
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .table th {
            background-color: rgb(255, 145, 0);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .table tbody tr:nth-child(even) {
            background-color: #ffe0b2;
        }

        .table tbody tr:hover {
            background-color: #ffcc80;
        }

        .table td {
            font-size: 1rem;
            font-weight: 400;
        }

        .table-responsive {
            max-height: 450px;
            overflow-y: auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .accordion-button:not(.collapsed) {
            background-color: rgb(255, 145, 0);
            color: white;
        }

        .accordion-button {
            background-color: #ffe0b2;
            color: #ff5722;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .btn-warning {
            background-color: #ff5722;
            color: white;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">#Foglalások</a>
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

    <header>
        <div class="container text-center">
            <h1>Foglalási Előzmények</h1>
            <p class="lead">Nézd meg a korábbi foglalásokat és szűrj könnyedén a táblázatban megjelenő adatok alapján.
            </p>
        </div>
    </header>

    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h3>Szűrőszekció</h3>
                <p>A szűrőszekció segítségével könnyedén kiválaszthatod a kívánt év, hónap, felnőttek száma, illetve a
                    napok száma alapján, hogy mely foglalásokat szeretnéd látni. Ez segít, hogy gyorsan átnézd az adott
                    időszakra vonatkozó adatokat, és csak a szükséges információkat jelenítse meg.</p>
            </div>
        </div>

        <form method="GET" action="{{ route('AdminFelulet.Foglalasok') }}">
            <div class="filter-section row mb-4 justify-content-center">
                <div class="col-md-4">
                    <label for="yearFilter" class="form-label">Év</label>
                    <select class="form-select" name="year" id="yearFilter">
                        <option value="">Minden év</option>
                        @for($i = 2020; $i <= now()->year-1 ; $i++)
                            <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
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
            </div>

            <div class="filter-section row mb-4 justify-content-center">
                <div class="col-md-4">
                    <label for="adultFilter" class="form-label">Felnőttek száma</label>
                    <select class="form-select" name="adults" id="adultFilter">
                        <option value="">Bármennyi</option>
                        @for($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}" {{ request('adults') == $i ? 'selected' : '' }}>{{ $i }} felnőtt</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="childFilter" class="form-label">Gyerekek száma</label>
                    <select class="form-select" name="children" id="childFilter">
                        <option value="">Bármennyi</option>
                        @for($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}" {{ request('children') == $i ? 'selected' : '' }}>{{ $i }} gyerek
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="filter-section row mb-4 justify-content-center">
                <div class="col-md-4">
                    <label for="csomagFilter" class="form-label">Csomag</label>
                    <select class="form-select" name="csomag" id="csomagFilter">
                        <option value="">Minden csomag</option>
                        @foreach($csomagok as $csomag)
                            <option value="{{ $csomag }}" {{ request('csomag') == $csomag ? 'selected' : '' }}>{{ $csomag }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="akcioFilter" class="form-label">Akció</label>
                    <select class="form-select" name="akcio" id="akcioFilter">
                        <option value="">Minden akció</option>
                        @foreach($akciok as $akcio)
                            <option value="{{ $akcio }}" {{ request('akcio') == $akcio ? 'selected' : '' }}>{{ $akcio }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <br>
            <div class="text-center">
                <button type="submit" class="btn btn-primary w-50">Szürés</button>
            </div>
        </form>

        <br>
        <h2 class="text-center">
            <hr>
            Foglalások
            <hr>
        </h2>
        <br>

        <div class="accordion" id="accordionExample">
            @foreach ($foglalasok as $foglalas)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $foglalas->foglalas_id }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $foglalas->foglalas_id }}" aria-expanded="true"
                            aria-controls="collapse{{ $foglalas->foglalas_id }}">
                            {{ $foglalas->vendeg->nev ?? 'Nincs név' }} – {{ $foglalas->erkezes }} →
                            {{ $foglalas->tavozas }} ({{ $foglalas->osszeg }} Ft)
                        </button>
                    </h2>
                    <div id="collapse{{ $foglalas->foglalas_id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $foglalas->foglalas_id }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table">
                                <tr>
                                    <th scope="col">Foglalás ID</th>
                                    <td>{{ $foglalas->foglalas_id ?? 'Nincs foglalás ID' }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Vendég ID</th>
                                    <td>{{ $foglalas->vendeg_id ?? 'Nincs vendég ID' }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Érkezés</th>
                                    <td>{{ $foglalas->erkezes }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Távozás</th>
                                    <td>{{ $foglalas->tavozas }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Felnőttek</th>
                                    <td>{{ $foglalas->felnott }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Gyerekek</th>
                                    <td>{{ $foglalas->gyerek }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Fizetett összeg</th>
                                    <td>{{ $foglalas->osszeg }} Ft</td>
                                </tr>
                                <tr>
                                    <th scope="col">Akciók</th>
                                    <td>
                                        @if($foglalas->akciok->isNotEmpty())
                                            {{ $foglalas->akciok->pluck('cim')->implode(', ') }}
                                        @else
                                            Nincs akció
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">Csomagok</th>
                                    <td>
                                        @if($foglalas->csomagok->isNotEmpty())
                                            {{ $foglalas->csomagok->pluck('nev')->implode(', ') }}
                                        @else
                                            Nincs csomag
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <footer class="footer">
            <p>&copy; 2025 Foglalási rendszer. Minden jog fenntartva - Készítette: Takács Áron</p>
        </footer>
        <script>

        </script>


</body>

</html>
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
            background-color: #ffffff;
            border-radius: 5px;
        }

        /* Egyéb stílusok */
        .footer {
            background-color: #ff5722;
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
            background-color: #ff5722;
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
            background-color: #ff5722;
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
                        <a class="nav-link active" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Foglalások</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Felhasználók</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Akciók</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Beállítások</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <header>
        <div class="container text-center">
            <h1>Foglalási Előzmények</h1>
            <p class="lead">Nézd meg a korábbi foglalásokat és szűrj könnyedén a táblázatban megjelenő adatok alapján.</p>
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
    
        <!-- Szűrő szekció -->
        <form method="GET" action="{{ route('foglalas.index') }}">
            <div class="filter-section row mb-4">
                <div class="col-md-3">
                    <label for="yearFilter" class="form-label">Év</label>
                    <select class="form-select" name="year" id="yearFilter">
                        <option value="">Minden év</option>
                        <option value="2021" {{ request('year') == '2021' ? 'selected' : '' }}>2021</option>
                        <option value="2022" {{ request('year') == '2022' ? 'selected' : '' }}>2022</option>
                        <option value="2023" {{ request('year') == '2023' ? 'selected' : '' }}>2023</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="monthFilter" class="form-label">Hónap</label>
                    <select class="form-select" name="month" id="monthFilter">
                        <option value="">Minden hónap</option>
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="adultFilter" class="form-label">Felnőttek száma</label>
                    <select class="form-select" name="adults" id="adultFilter">
                        <option value="">Bármennyi</option>
                        @for($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}" {{ request('adults') == $i ? 'selected' : '' }}>{{ $i }} felnőtt</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="daysFilter" class="form-label">Napok száma</label>
                    <select class="form-select" name="days" id="daysFilter">
                        <option value="">2-14 nap</option>
                        @for($i = 2; $i <= 14; $i++)
                            <option value="{{ $i }}" {{ request('days') == $i ? 'selected' : '' }}>{{ $i }} nap</option>
                        @endfor
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Szűrés alkalmazása</button>
        </form>
    
        <div class="accordion" id="accordionExample">
            
            @foreach ($foglalasok as $foglalas)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $foglalas->id }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $foglalas->id }}" aria-expanded="true" aria-controls="collapse{{ $foglalas->id }}">
                            Foglalás ID: {{ $foglalas->id }}
                        </button>
                    </h2>
                    <div id="collapse{{ $foglalas->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $foglalas->id }}"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table">
                                <tr>
                                    <th scope="col">Foglalás ID</th>
                                    <td>{{ $foglalas->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Vendég ID</th>
                                    <td>{{ $foglalas->vendeg_id }}</td>
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
                                    <th scope="col">Foglalás állapot</th>
                                    <td>{{ $foglalas->foglalas_allapot }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Fizetés állapot</th>
                                    <td>{{ $foglalas->fizetes_allapot }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <footer class="footer">
        <p>&copy; 2025 Foglalási rendszer. Minden jog fenntartva.</p>
    </footer>

        <script>

            document.getElementById("loadMoreBtn").addEventListener("click", function () {
                alert("További foglalások betöltése...");

            });


            document.getElementById('yearFilter').addEventListener('change', filterTable);
            document.getElementById('monthFilter').addEventListener('change', filterTable);
            document.getElementById('adultFilter').addEventListener('change', filterTable);
            document.getElementById('priceFilter').addEventListener('input', filterTable);

            function filterTable() {
                const year = document.getElementById('yearFilter').value;
                const month = document.getElementById('monthFilter').value;
                const adults = document.getElementById('adultFilter').value;
                const price = document.getElementById('priceFilter').value;

                const rows = document.querySelectorAll('#reservationTable tr');

                rows.forEach(row => {
                    const cells = row.children;
                    const rowYear = cells[2].textContent.split('-')[0];
                    const rowMonth = cells[2].textContent.split('-')[1];
                    const rowAdults = cells[4].textContent;
                    const rowPrice = cells[6].textContent;

                    const showRow =
                        (year === "" || rowYear === year) &&
                        (month === "" || rowMonth === month) &&
                        (adults === "" || rowAdults == adults) &&
                        (price === "" || rowPrice >= price);

                    row.style.display = showRow ? "" : "none";
                });
            }
        </script>
</body>

</html>
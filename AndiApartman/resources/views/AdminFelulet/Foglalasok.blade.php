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
                        @for($i = 2020; $i <= now()->year - 1; $i++)
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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <div class="container">
            <hr>
            <h1 class="text-center">Statisztika</h1>
            <hr>
            <br>
            <div class="container mt-4">

                <div class="row">
                    <div class="col-md-4 mx-auto">
                        <label for="evValaszto" class="form-label">Válassz évet:</label>
                        <select id="evValaszto" class="form-select">
                            <option value="">Összes év (2020-2024)</option>
                            @foreach($evek as $ev)
                                <option value="{{ $ev }}" {{ $ev == $year ? 'selected' : '' }}>{{ $ev }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <!-- Diagram -->
                <div class="row">

                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <h4 class="text-center">Foglalások Összeg (Éves bontás)</h4>
                        <div class="chart-container">
                            <canvas id="foglalasokChart"></canvas>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <h4 class="text-center">Vendégek Száma (Éves bontás)</h4>
                        <div class="chart-container">
                            <canvas id="vendegekChart"></canvas>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <h4 class="text-center">Foglalások Átlagos Hossza (Éves bontás)</h4>
                        <div class="chart-container">
                            <canvas id="atlagosHosszChart"></canvas>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <h4 class="text-center">Csomagok Összesen (Éves Bontásban)</h4>
                        <div class="chart-container">
                            <canvas id="csomagokChart"></canvas>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                        <h4 class="text-center">Akciók Összesen (Éves bontásban)</h4>
                        <div class="chart-container">
                            <canvas id="akciokChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <h4 class="text-center">Elfogadott Értékelések</h4>
                        <div class="chart-container">
                            <canvas id="velemenyekWaterfallChart"></canvas>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <h4 class="text-center">Visszajáró Vendégek</h4>
                        <div class="chart-container">
                            <canvas id="visszajaroVendegChart"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <h4 class="text-center">Fizetések Csoportositva</h4>
                        <div class="chart-container">
                            <canvas id="paymentChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <canvas id="monthlyBookingsChart"></canvas>
    </div>
    </div>
    <script>

        document.addEventListener("DOMContentLoaded", function () {
            let ctx = document.getElementById("foglalasokChart").getContext("2d");

            let isYearSelected = @json($isYearSelected); // true, ha év lett kiválasztva
            let labels = isYearSelected ?
                @json($foglalasokEvonta->pluck('honap')) :
                @json($foglalasokEvonta->pluck('ev'));

            let foglalasokData = {
                labels: labels,
                datasets: [{
                    label: "Foglalások Összeg",
                    data: @json($foglalasokEvonta->pluck('osszeg')),
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1
                }]
            };

            let foglalasokChart = new Chart(ctx, {
                type: "bar",
                data: foglalasokData,
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            document.getElementById("evValaszto").addEventListener("change", function () {
                let selectedYear = this.value;
                let url = selectedYear ? `?year=${selectedYear}` : "?year=";
                window.location.href = url;
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            let ctxVendeg = document.getElementById("vendegekChart").getContext("2d");

            let isYearSelected = @json($isYearSelected);
            let labelsVendeg = isYearSelected ?
                @json($vendegSzamEvonta->pluck('honap')) :
                @json($vendegSzamEvonta->pluck('ev'));

            let vendegSzamData = {
                labels: labelsVendeg,
                datasets: [
                    {
                        label: "Gyerekek",
                        data: @json($vendegSzamEvonta->pluck('gyerekek_szama')),
                        backgroundColor: "rgba(255, 99, 132, 0.2)",
                        borderColor: "rgba(255, 99, 132, 1)",
                        borderWidth: 1
                    },
                    {
                        label: "Felnőttek",
                        data: @json($vendegSzamEvonta->pluck('felnott_szama')),
                        backgroundColor: "rgba(54, 162, 235, 0.2)",
                        borderColor: "rgba(54, 162, 235, 1)",
                        borderWidth: 1
                    }
                ]
            };

            let vendegekChart = new Chart(ctxVendeg, {
                type: "bar",
                data: vendegSzamData,
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            document.getElementById("evValaszto").addEventListener("change", function () {
                let selectedYear = this.value;
                let url = selectedYear ? `?year=${selectedYear}` : "?year=";
                window.location.href = url;
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
            let ctxAtlag = document.getElementById("atlagosHosszChart").getContext("2d");

            let isYearSelected = @json($isYearSelected);
            let labelsAtlag = isYearSelected ?
                @json($atlagosHosszEvonta->pluck('honap')) :
                @json($atlagosHosszEvonta->pluck('ev'));

            let atlagosHosszData = {
                labels: labelsAtlag,
                datasets: [
                    {
                        label: "Átlagos Foglalási Hossz (napok)",
                        data: @json($atlagosHosszEvonta->pluck('atlag_hossz')),
                        backgroundColor: "rgba(153, 102, 255, 0.2)",
                        borderColor: "rgba(153, 102, 255, 1)",
                        borderWidth: 1
                    }
                ]
            };

            let atlagosHosszChart = new Chart(ctxAtlag, {
                type: "bar",
                data: atlagosHosszData,
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            document.getElementById("evValaszto").addEventListener("change", function () {
                let selectedYear = this.value;
                let url = selectedYear ? `?year=${selectedYear}` : "?year=";
                window.location.href = url;
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
            let ctxCsomagok = document.getElementById("csomagokChart").getContext("2d");
            let ctxAkciok = document.getElementById("akciokChart").getContext("2d");

            // Csomagok adatok
            let csomagokData = {
                labels: @json($csomagokST->pluck('nev')),
                datasets: [{
                    label: "Foglalások Száma",
                    data: @json($csomagokST->pluck('foglalasok_szama')),
                    backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0", "#9966FF"],
                    hoverOffset: 10
                }]
            };

            // Akciók adatok
            let akciokData = {
                labels: @json($akciokST->pluck('cim')),
                datasets: [{
                    label: "Foglalások Száma",
                    data: @json($akciokST->pluck('foglalasok_szama')),
                    backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0", "#9966FF"],
                    hoverOffset: 10
                }]
            };

            // Csomagok kördiagram (3D hatással)
            let csomagokChart = new Chart(ctxCsomagok, {
                type: "doughnut",
                data: csomagokData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: "bottom" }
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: true
                    }
                }
            });


            let akciokChart = new Chart(ctxAkciok, {
                type: "doughnut",
                data: akciokData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: "bottom" }
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: true
                    }
                }
            });


            document.getElementById("evValaszto").addEventListener("change", function () {
                let selectedYear = this.value;
                let url = selectedYear ? `?year=${selectedYear}` : "?year=";
                window.location.href = url;
            });
        });

        var ctxErtekeles = document.getElementById('velemenyekErtekelesChart').getContext('2d');
        var ertekelesChart = new Chart(ctxErtekeles, {
            type: 'bar',
            data: {
                labels: ['1 csillag', '2 csillag', '3 csillag', '4 csillag', '5 csillag'],
                datasets: [{
                    label: 'Értékelések száma',
                    data: [
                        @foreach($velemenyekErtekeles as $index => $adat)
                            {{ $adat->db }} @if(!$loop->last), @endif
                        @endforeach
            ],
                    backgroundColor: ['#ff4d4d', '#ffa64d', '#ffd633', '#a6d854', '#66cc66'],
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


        var ctxVisszatero = document.getElementById('visszateroVendegChart').getContext('2d');
        var visszateroChart = new Chart(ctxVisszatero, {
            type: 'pie',
            data: {
                labels: ['Visszatérő vendégek', 'Új vendégek'],
                datasets: [{
                    data: [{{ $visszateroVendegSzama }}, {{ $osszesVendeg - $visszateroVendegSzama }}],
                    backgroundColor: ['#36A2EB', '#FF6384'],
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });


        document.getElementById("evValaszto").addEventListener("change", function () {
            let selectedYear = this.value;
            let url = selectedYear ? `?year=${selectedYear}` : "?year=";
            window.location.href = url;
        });


        document.addEventListener("DOMContentLoaded", function () {
            // Bankkártyás és Utalásos összegek átvétele PHP-ból
            const bankkartyasOsszeg = parseFloat("{{ $bankkartyasOsszeg }}");  // Számként konvertálás
            const utalasOsszeg = parseFloat("{{ $utalasOsszeg }}");

            // Ellenőrzés, hogy a PHP változók érvényes számok-e
            console.log('Bankkártyás összeg:', bankkartyasOsszeg);
            console.log('Utalásos összeg:', utalasOsszeg);

            if (isNaN(bankkartyasOsszeg) || isNaN(utalasOsszeg)) {
                console.error("A PHP változók nem tartalmaznak érvényes számokat!");
            } else {
                // Diagram adatainak beállítása
                const data = {
                    labels: ['Bankkártyás', 'Utalásos'],  // Kategóriák
                    datasets: [{
                        label: 'Fizetési módok összege',
                        data: [bankkartyasOsszeg, utalasOsszeg],  // A PHP-ból átvett adatok
                        backgroundColor: ['#00C49F', '#FF8042'],  // Színek
                        borderColor: ['#008C68', '#FF5722'],
                        borderWidth: 1
                    }]
                };

                // Chart.js beállításai
                const config = {
                    type: 'pie',  // Kördiagram
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        const value = context.raw;
                                        return context.label + ': ' + value.toLocaleString() + ' Ft';  // Pénznem formázás
                                    }
                                }
                            }
                        }
                    }
                };

                // Az új kördiagram létrehozása
                const ctx = document.getElementById('paymentChart').getContext('2d');
                new Chart(ctx, config);
            }

            // Évválasztó változtatása esetén az oldal újratöltése a kiválasztott évvel
            document.getElementById("evValaszto").addEventListener("change", function () {
                let year = this.value;
                let url = year ? `?year=${year}` : "?year=";
                window.location.href = url;
            });
        });

    </script>

    <footer class="footer">
        <p>&copy; 2025 Foglalási rendszer. Minden jog fenntartva - Készítette: Takács Áron</p>
    </footer>




</body>

</html>
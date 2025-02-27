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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">#Foglalások</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto text-center">
                    <li class="nav-item ">
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

        <div class="container mt-4">
            <!-- Szűrő szekció -->
            <div class="filter-section row mb-4">
                <div class="col-md-3">
                    <label for="yearFilter" class="form-label">Év</label>
                    <select class="form-select" id="yearFilter">
                        <option value="">Minden év</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="monthFilter" class="form-label">Hónap</label>
                    <select class="form-select" id="monthFilter">
                        <option value="">Minden hónap</option>
                        <option value="1">Január</option>
                        <option value="2">Február</option>
                        <option value="3">Március</option>
                        <option value="4">Április</option>
                        <option value="5">Május</option>
                        <option value="6">Június</option>
                        <option value="7">Július</option>
                        <option value="8">Augusztus</option>
                        <option value="9">Szeptember</option>
                        <option value="10">Október</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="adultFilter" class="form-label">Felnőttek száma</label>
                    <select class="form-select" id="adultFilter">
                        <option value="">Bármennyi</option>
                        <option value="1">1 felnőtt</option>
                        <option value="2">2 felnőtt</option>
                        <option value="3">3 felnőtt</option>
                        <option value="4">4 felnőtt</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="daysFilter" class="form-label">Napok száma</label>
                    <select class="form-select" id="daysFilter">
                        <option value="">2-14 nap</option>
                        <option value="2">2 nap</option>
                        <option value="3">3 nap</option>
                        <option value="4">4 nap</option>
                        <option value="5">5 nap</option>
                        <option value="6">6 nap</option>
                        <option value="7">7 nap</option>
                        <option value="8">8 nap</option>
                        <option value="9">9 nap</option>
                        <option value="10">10 nap</option>
                        <option value="11">11 nap</option>
                        <option value="12">12 nap</option>
                        <option value="13">13 nap</option>
                        <option value="14">14 nap</option>
                    </select>
                </div>
            </div>
            <div class="accordion" id="accordionExample">
                <!-- Foglalás 1 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            1 - Foglalás ID: 1001
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table">
                                <tr>
                                    <th scope="col">Foglalás ID</th>
                                    <td>1001</td>
                                </tr>
                                <tr>
                                    <th scope="col">Vendég ID</th>
                                    <td>12345</td>
                                </tr>
                                <tr>
                                    <th scope="col">Érkezés</th>
                                    <td>2025-02-15</td>
                                </tr>
                                <tr>
                                    <th scope="col">Távozás</th>
                                    <td>2025-02-20</td>
                                </tr>
                                <tr>
                                    <th scope="col">Felnőttek</th>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <th scope="col">Gyerekek</th>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <th scope="col">Fizetett összeg</th>
                                    <td>12000 Ft</td>
                                </tr>
                                <tr>
                                    <th scope="col">Foglalás állapot</th>
                                    <td>Folyamatban</td>
                                </tr>
                                <tr>
                                    <th scope="col">Fizetés állapot</th>
                                    <td>Fizetve</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Foglalás 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            2 - Foglalás ID: 1002
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table">
                                <tr>
                                    <th scope="col">Foglalás ID</th>
                                    <td>1002</td>
                                </tr>
                                <tr>
                                    <th scope="col">Vendég ID</th>
                                    <td>54321</td>
                                </tr>
                                <tr>
                                    <th scope="col">Érkezés</th>
                                    <td>2025-03-01</td>
                                </tr>
                                <tr>
                                    <th scope="col">Távozás</th>
                                    <td>2025-03-05</td>
                                </tr>
                                <tr>
                                    <th scope="col">Felnőttek</th>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <th scope="col">Gyerekek</th>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th scope="col">Fizetett összeg</th>
                                    <td>15000 Ft</td>
                                </tr>
                                <tr>
                                    <th scope="col">Foglalás állapot</th>
                                    <td>Teljesítve</td>
                                </tr>
                                <tr>
                                    <th scope="col">Fizetés állapot</th>
                                    <td>Fizetve</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- További foglalások betöltésére szolgáló gomb -->
                <div class="text-center">
                    <button id="loadMoreBtn" class="btn btn-warning mt-4">További foglalások betöltése...</button>
                </div>
            </div>
        </div>

        <!-- Footer -->
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
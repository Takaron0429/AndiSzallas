<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="{{ asset('AdminLogin.css') }}">

    <title>Admin Főoldal</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
        }

        .container {
            margin-top: 30px;
        }

        .navbar {
            background-color: #ff8c00;
        }

        .navbar-brand,
        .nav-link {
            color: white;
        }

        .navbar-brand:hover,
        .nav-link:hover {
            color: #e07b00;
        }

        .card-header {
            background-color: #ff8c00;
            color: white;
        }

        .card-body {
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: #ff8c00;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #ffe0b3;
        }

        .modal-header {
            background-color: #ff8c00;
            color: white;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .modal-body {
            padding: 20px;
        }

        .footer {
            background-color: #f1f1f1;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg" >
            <div class="container">
                <a class="navbar-brand" href="#">Admin#Felület</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Foglalások</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Új foglalás</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Beállítások</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kijelentkezés</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container dashboard-container">
            <h3>Üdvözlöm, {{ $admin['felhasznalonev'] }}!</h3>
            <p>Email: {{ $admin['email'] }}</p>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Új foglalások</div>
                        <div class="card-body">
                            <i class="fas fa-calendar-check widget"></i>
                            <div class="widget-value">35</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Szobák elérhetősége</div>
                        <div class="card-body">
                            <i class="fas fa-bed widget"></i>
                            <div class="widget-value">12</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Admin tevékenység</div>
                        <div class="card-body">
                            <i class="fas fa-users widget"></i>
                            <div class="widget-value">5</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <!-- Foglalások Lista -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Foglalások</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Név</th>
                                    <th>Email</th>
                                    <th>Foglalás dátuma</th>
                                    <th>Állapot</th>
                                    <th>Részletek</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>johndoe@email.com</td>
                                    <td>2025-02-15</td>
                                    <td>Folyamatban</td>
                                    <td><button class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#bookingModal1">Részletek</button></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jane Smith</td>
                                    <td>janesmith@email.com</td>
                                    <td>2025-02-20</td>
                                    <td>Teljesítve</td>
                                    <td><button class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#bookingModal2">Részletek</button></td>
                                </tr>
                              
                            </tbody>
                        </table>
                    </div>
                </div>

            
                <div class="modal fade" id="bookingModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Foglalás Részletei</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Név:</strong> John Doe</p>
                                <p><strong>Email:</strong> johndoe@email.com</p>
                                <p><strong>Dátum:</strong> 2025-02-15</p>
                                <p><strong>Állapot:</strong> Folyamatban</p>
                                <p><strong>Megjegyzés:</strong> Speciális igények: Külön ágyak, reggeli</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégse</button>
                                <button type="button" class="btn btn-primary">Foglalás frissítése</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="footer">
                    <p>&copy; 2025 Admin Felület | Minden jog fenntartva</p>
                </div>
            </div>



            <a href="{{ route('admin.login') }}" class="btn btn-danger w-100">Kijelentkezés</a>
        </div>

    </div>
</body>

</html>
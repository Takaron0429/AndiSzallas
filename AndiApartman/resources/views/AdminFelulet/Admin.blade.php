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
    <link rel="stylesheet" href="{{ asset('AdminLogin.css') }}">

    <title>Admin Főoldal</title>

</head>

<body>


 
    <div class="container">
        <div class="main-content" id="mainContent">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-sm-12 col-lg-6">
                        <div class="card shadow-lg">
                            <div class="card-body text-center">
                                <img src="{{ asset('kepek/boss.png') }}" class="rounded-circle mb-3" alt="Admin Avatar"
                                    width="120">
                                <h3 class="card-title text-primary fw-bold">Üdvözlöm, {{ $admin['felhasznalonev'] }}!
                                </h3>
                                <p class="card-text text-muted">📧 Email: <strong>{{ $admin['email'] }}</strong></p>
                                <p class="badge bg-success p-2">Admin Boss ✅</p>
                                <p class="badge bg-success p-2">Fő Admin ✅</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
      
        </script>
        <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-header">Új foglalások</div>
                    <div class="card-body">
                        <i class="fas fa-calendar-check widget"></i>
                        <div class="widget-value">35</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-header">Szobák elérhetősége</div>
                    <div class="card-body">
                        <i class="fas fa-bed widget"></i>
                        <div class="widget-value">12</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-header">Admin tevékenység</div>
                    <div class="card-body">
                        <i class="fas fa-users widget"></i>
                        <div class="widget-value">5</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container ">
            <div class="row">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Foglalások</h4>
                    </div>
                    <div class="card-body col-sm-12">
                        <table class="table table-striped table-hover">
                            <thead class="col-12">
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

                                <tr class="col-12">
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>johndoe@email.com</td>
                                    <td>2025-02-15</td>
                                    <td>Folyamatban</td>
                                    <td><button class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#bookingModal1">Részletek</button></td>
                                </tr>
                                <tr class="col-12">
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
            </div>
        </div>

        <div class="modal fade" id="bookingModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Foglalás Részletei</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <button type="button" class="btn btn-danger">Törlés XXX</button>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.login') }}" class="btn btn-danger w-100">Kijelentkezés</a>
        <!-- Footer -->
        <div class="footer">
            <p class="text-left">&copy; 2025 Admin Felület | Minden jog fenntartva</p>
        </div>
    </div>




    </div>


</body>

</html>
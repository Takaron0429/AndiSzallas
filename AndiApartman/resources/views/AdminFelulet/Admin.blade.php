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


    @php
        $admin = Auth::user();
    @endphp
    <div class="container">
        <div class="main-content" id="mainContent">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-sm-12 col-lg-6">
                        <div class="card shadow-lg">
                            <div class="card-body text-center">
                                @foreach([session('admin')] as $admin)
                                    @if($admin)
                                        <div class="card shadow-lg mb-3">
                                            <div class="card-body text-center">
                                                <img src="{{ asset('kepek/boss.png') }}" class="rounded-circle mb-3"
                                                    alt="Admin Avatar" width="120">
                                                <h3 class="card-title text-primary fw-bold">Üdvözlöm,
                                                    {{ $admin['felhasznalonev'] }}!</h3>
                                                <p class="card-text text-muted">📧 Email: <strong>{{ $admin['email'] }}</strong>
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

            </script>
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-header">Új foglalások</div>
                        <div class="card-body">
                            <i class="fas fa-calendar-check widget"></i>
                            <div class="widget-value">8</div>
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


            <div class="container">
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
                                    @foreach ($Foglalas as $foglalas) 
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            @foreach ($Foglalas as $foglalas)
                <div class="modal fade" id="bookingModal{{ $foglalas->foglalas_id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Foglalás Részletei</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Név:</strong> {{ $foglalas->vendeg->nev ?? 'Nincs név' }}</p>
                                <p><strong>Email:</strong> {{ $foglalas->vendeg->email ?? 'Nincs email' }}</p>
                                <p><strong>Érkezés:</strong> {{ $foglalas->erkezes }}</p>
                                <p><strong>Távozás:</strong> {{ $foglalas->tavozas }}</p>
                                <p><strong>Felnőttek:</strong> {{ $foglalas->felnott }}</p>
                                <p><strong>Gyerekek:</strong> {{ $foglalas->gyerek }}</p>
                                <p><strong>Fizetett összeg:</strong> {{ $foglalas->osszeg }} Ft</p>
                                <p><strong>Foglalás állapot:</strong> {{ $foglalas->foglalas_allapot }}</p>
                                <p><strong>Fizetés állapot:</strong> {{ $foglalas->fizetes_allapot }}</p>
                                <p><strong>Megjegyzés:</strong> {{ $foglalas->megjegyzes ?? 'Nincs megjegyzés' }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégse</button>
                                <button type="button" class="btn btn-primary">Foglalás frissítése</button>
                                <button type="button" class="btn btn-danger">Törlés</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <a href="{{ route('admin.login') }}" class="btn btn-danger w-100">Kijelentkezés</a>

            <div class="footer">
                <p class="text-left">&copy; 2025 Admin Felület | Minden jog fenntartva | Készitette Takács Áron</p>
            </div>
        </div>




    </div>


</body>

</html>
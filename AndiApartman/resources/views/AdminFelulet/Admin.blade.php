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
        .widget {
            font-size: 2rem;
            color: #007bff;
        }

        .widget-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        /* Kártyákhoz egy kis háttér és árnyék */
        .mt-4 .card {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .mt-4  .card-header {
            font-size: 1.25rem;
            background-color: #f8f9fa;
        }

        .mt-4  .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .widget-value {
            font-size: 2rem;
            color: #495057;
        }
    </style>
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

            </script>
            <div class="row">
                <div class="container mt-4">
                    <div class="row">
                        <!-- Új foglalások -->
                        <div class="col-md-4 col-lg-4 col-sm-12 mb-4">
                            <div class="card">
                                <div class="card-header">Új foglalások</div>
                                <div class="card-body">
                                    <i class="fas fa-calendar-check widget"></i>
                                    <div class="widget-value">{{ $ujFoglalasok }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Szobák elérhetősége -->
                        <div class="col-md-4 col-lg-4 col-sm-12 mb-4">
                            <div class="card">
                                <div class="card-header">Szobák elérhetősége</div>
                                <div class="card-body">
                                    <i class="fas fa-bed widget"></i>
                                    <div class="widget-value">{{ $lefoglaltNapok }} / {{ $totalDays ?? 0 }}</div>
                                    <!-- Lefoglalt / Összes nap -->
                                </div>
                            </div>
                        </div>

                        <!-- Eddig befolyt összeg -->
                        <div class="col-md-4 col-lg-4 col-sm-12 mb-4">
                            <div class="card">
                                <div class="card-header">Eddig Befolyt Összeg</div>
                                <div class="card-body">
                                    <i class="fas fa-dollar-sign widget"></i>
                                    <div class="widget-value">{{ $osszegKerekitve }} Ft</div>
                                </div>
                            </div>
                        </div>

                        <!-- Visszajáró vendégek -->
                        <div class="col-md-4 col-lg-4 col-sm-12 mb-4">
                            <div class="card">
                                <div class="card-header">Visszajáró vendégek</div>
                                <div class="card-body">
                                    <i class="fas fa-users widget"></i>
                                    <div class="widget-value">{{ $visszajaroVendegSzam }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- További statisztika -->
                        <div class="col-md-4 col-lg-4 col-sm-12 mb-4">
                            <div class="card">
                                <div class="card-header">További statisztika</div>
                                <div class="card-body">
                                    <div class="widget-value">{{ $visszajaroVendegSzam }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12 mb-4">
                            <div class="card">
                                <div class="card-header">További statisztika</div>
                                <div class="card-body">
                                    <div class="widget-value">{{ $visszajaroVendegSzam }}</div>
                                </div>
                            </div>
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
                                                <p><strong>Csomag:</strong> {{ $foglalas->csomag->nev ?? 'Nincs csomag' }}
                                                    ({{ $foglalas->csomag->ar ?? 0 }} Ft)</p>
                                                <p><strong>Akció kedvezmény:</strong>
                                                    {{ $foglalas->akcio->kedvezmeny_szazalek ?? 0 }}%</p>
                                                <p><strong>Végső összeg:</strong> <span
                                                        id="osszegMegjelenit{{ $foglalas->foglalas_id }}">{{ $foglalas->osszeg }}</span>
                                                    Ft</p>
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
                                                                <option value="{{ $csomag->csomag_id }}" {{ $csomag->csomag_id == $foglalas->csomag_id ? 'selected' : '' }}>
                                                                    {{ $csomag->nev }} ({{ $csomag->ar }} Ft)
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
        document.querySelectorAll('select[name="csomag_id"], select[name="akcio_id"], input[name="felnott"], input[name="gyerek"], input[name="erkezes"], input[name="tavozas"]').forEach((input) => {
            input.addEventListener('change', function () {
                const form = this.closest('form');
                const csomagId = form.querySelector('select[name="csomag_id"]').value;
                const akcioId = form.querySelector('select[name="akcio_id"]').value;
                const felnott = form.querySelector('input[name="felnott"]').value;
                const gyerek = form.querySelector('input[name="gyerek"]').value;
                const erkezes = form.querySelector('input[name="erkezes"]').value;
                const tavozas = form.querySelector('input[name="tavozas"]').value;


                if (csomagId && erkezes && tavozas && felnott >= 0 && gyerek >= 0) {
                    const csomagAr = 1000;
                    const akcioSzazalek = 20;

                    const napok = (new Date(tavozas) - new Date(erkezes)) / (1000 * 3600 * 24);
                    const alapAr = (felnott * csomagAr + gyerek * csomagAr) * napok;
                    let osszeg = alapAr;

                    if (akcioId) {
                        osszeg -= osszeg * (akcioSzazalek / 100);
                    }

                    form.querySelector('#osszeg').value = `${osszeg.toFixed(2)} Ft`;
                }
            });
        });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('AdminLogin.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminMod.css') }}">
    <style>
        h2 {
            text-align: center;
        }
    </style>
    <title>Admin Módosítás</title>
</head>

<body>
    <div class="container mt-5 pt-5">
        <br>
        <nav class="container mt-6 navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">#Foglalások</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto text-center">
                        <li class="nav-item"><a class="nav-link active"
                                href="{{ route('AdminFelulet.Admin') }}">Admin#Panel</a></li>
                        <li class="nav-item"><a class="nav-link"
                                href="{{ route('AdminFelulet.Foglalasok') }}">Foglalások</a></li>
                        <li class="nav-item"><a class="nav-link"
                                href="{{ route('AdminFelulet.Modositasok') }}">Módosítások</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.logout') }}">Kijelentkezés</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>


        <div class="container">
            <div class="row category-buttons text-center">
                <div class="col"><button class="btn btn-primary" onclick="showSection('csomag')">Csomagok</button></div>
                <div class="col"><button class="btn btn-success" onclick="showSection('akcio')">Akciók</button></div>
                <div class="col"><button class="btn btn-warning" style="color: white"
                        onclick="showSection('program')">Programok</button>
                </div>
                <div class="col"><button class="btn btn-danger" onclick="showSection('Foglalas')">Foglalás</button>
                </div>
            </div>
            <style>
                .table-container {
                    padding: 20px;
                    border-radius: 15px;
                    background-color: rgba(255, 100, 0, 0.2);
                    /* Narancsos üveges hatás helyett */
                    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
                }

                .table {
                    width: 100%;
                    border-collapse: collapse;
                }

                .table th {
                    background: rgba(255, 140, 0, 0.8);
                    /* Melegebb narancs árnyalat */
                    color: #fff;
                    padding: 10px;
                    text-transform: uppercase;
                    border-radius: 8px;
                }

                .table-striped tbody tr:nth-child(odd) {
                    background: rgba(255, 120, 0, 0.3);
                    /* Narancssárga sávok */
                }

                .table-striped tbody tr:hover {
                    background: rgba(255, 165, 50, 0.5);
                    /* Erősebb narancs hover */
                    transition: 0.3s;
                }
            </style>
            <!-- Csomagok -->
            <div id="csomag" class="table-container">
                <h2>Csomagok</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Név</th>
                            <th>Leírás</th>
                            <th>Ár</th>
                            <th>Elérhető</th>
                            <th>Akciók</th>
                        </tr>
                    </thead>
                    <tbody class="w-100">
                        @foreach ($ErkezesiCsomag as $csomag)
                            <tr>
                                <td>{{ $csomag->csomag_id }}</td>
                                <td>{{ $csomag->nev }}</td>
                                <td>{{ $csomag->leiras }}</td>
                                <td>{{ $csomag->ar }} Ft</td>
                                <td>{{ $csomag->elerheto }}</td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#csomagModal{{ $csomag->csomag_id }}">Módosítás</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <form class="form-container" action="{{ route('Erkezesi.store') }}" method="POST">
                    @csrf
                    <input type="text" class="form-control mb-2" name="nev" placeholder="Csomag neve" required>
                    <input type="text" class="form-control mb-2" name="leiras" placeholder="Leírás" required>
                    <input type="number" class="form-control mb-2" name="ar" placeholder="Ár" required>
                    <input type="number" class="form-control mb-2" name="elerheto" placeholder="Elérhető mennyiség"
                        required>
                    <button type="submit" class="btn btn-primary">Hozzáadás</button>
                </form>
            </div>

            @foreach ($ErkezesiCsomag as $csomag)
                <div class="modal fade" id="csomagModal{{ $csomag->csomag_id }}" tabindex="-1"
                    aria-labelledby="csomagModalLabel{{ $csomag->csomag_id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="csomagModalLabel{{ $csomag->csomag_id }}">Csomag Módosítása</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('Erkezesi.update', $csomag->csomag_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="nev" class="form-label">Név</label>
                                        <input type="text" class="form-control" name="nev" value="{{ $csomag->nev }}"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="leiras" class="form-label">Leírás</label>
                                        <input type="text" class="form-control" name="leiras" value="{{ $csomag->leiras }}"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ar" class="form-label">Ár</label>
                                        <input type="number" class="form-control" name="ar" value="{{ $csomag->ar }}"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="elerheto" class="form-label">Elérhető mennyiség</label>
                                        <input type="number" class="form-control" name="elerheto"
                                            value="{{ $csomag->elerheto }}" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Mégse</button>
                                        <button type="submit" class="btn btn-warning">Frissítés</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


            <div id="akcio" class="table-container">
                <h2>Akciók</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Név</th>
                            <th>Kedvezmény</th>
                            <th>Leírás</th>
                            <th>Kezdete</th>
                            <th>Vége</th>
                            <th>Akciók</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Akcio as $akcio)
                            <tr>
                                <td>{{ $akcio->akcio_id }}</td>
                                <td>{{ $akcio->cim }}</td>
                                <td>{{ $akcio->kedvezmeny_szazalek }}%</td>
                                <td>{{ $akcio->leiras }}</td>
                                <td>{{ $akcio->kezdete }}</td>
                                <td>{{ $akcio->vege }}</td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#akcioModal{{ $akcio->akcio_id }}">Módosítás</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <form class="form-container" action="{{ route('Akcio.store') }}" method="POST">
                    @csrf
                    <input type="text" class="form-control mb-2" name="cim" placeholder="Akció neve" required>
                    <input type="number" class="form-control mb-2" name="kedvezmeny_szazalek" placeholder="Kedvezmény %"
                        required>
                    <textarea class="form-control mb-2" name="leiras" placeholder="Leírás"></textarea>
                    <input type="date" class="form-control mb-2" name="kezdete" required>
                    <input type="date" class="form-control mb-2" name="vege" required>
                    <button type="submit" class="btn btn-success w-25">Hozzáadás</button>
                </form>
            </div>

            <!-- Modal for editing Akció -->
            @foreach ($Akcio as $akcio)
                <div class="modal fade" id="akcioModal{{ $akcio->akcio_id }}" tabindex="-1"
                    aria-labelledby="akcioModalLabel{{ $akcio->akcio_id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="akcioModalLabel{{ $akcio->akcio_id }}">Akció Módosítása</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('Akcio.update', $akcio->akcio_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="cim" class="form-label">Akció Neve</label>
                                        <input type="text" class="form-control" name="cim" value="{{ $akcio->cim }}"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kedvezmeny_szazalek" class="form-label">Kedvezmény</label>
                                        <input type="number" class="form-control" name="kedvezmeny_szazalek"
                                            value="{{ $akcio->kedvezmeny_szazalek }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="leiras" class="form-label">Leírás</label>
                                        <textarea class="form-control" name="leiras"
                                            required>{{ $akcio->leiras }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="kezdete" class="form-label">Kezdete</label>
                                        <input type="date" class="form-control" name="kezdete" value="{{ $akcio->kezdete }}"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="vege" class="form-label">Vége</label>
                                        <input type="date" class="form-control" name="vege" value="{{ $akcio->vege }}"
                                            required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Mégse</button>
                                        <button type="submit" class="btn btn-warning">Frissítés</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <style>

            </style>
            <div id="program" class="table-container" style="display: block">
                <h2>Programok</h2>
                <br>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Program neve</th>
                            <th>Helyszín</th>
                            <th>Kezdés</th>
                            <th>Befejezés</th>
                            <th>Link</th>
                            <th>Akciók</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($HelyiProgramajanlo as $program)
                            <tr>
                                <td>{{ $program->cim }}</td>
                                <td>{{ $program->helyszin }}</td>
                                <td>{{ $program->kezdet }}</td>
                                <td>{{ $program->vege }}</td>
                                <td><a href="{{ $program->link }}" target="_blank">Megtekintés</a></td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#programModal{{ $program->program_id }}">
                                        Módosítás
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <script></script>
                </table>
                <form class="form-container" action="{{ route('Helyi.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <!-- Bal oldal -->
                        <div class="col-md-6">
                            <div class="p-3 border rounded shadow-sm">
                                <h5 class="text-center">Program Adatok</h5>

                                <div class="mb-3">
                                    <label for="cim" class="form-label">Program neve</label>
                                    <input type="text" class="form-control" name="cim" value="{{ old('cim') }}"
                                        placeholder="Program neve" required>
                                    @error('cim') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="helyszin" class="form-label">Helyszín</label>
                                    <input type="text" class="form-control" name="helyszin"
                                        value="{{ old('helyszin') }}" placeholder="Helyszín" required>
                                    @error('helyszin') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="leiras" class="form-label">Leírás</label>
                                    <textarea class="form-control" name="leiras"
                                        placeholder="Program leírása">{{ old('leiras') }}</textarea>
                                    @error('leiras') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-warning mt-3">Hozzáadás</button>
                                </div>
                            </div>
                        </div>

                        <!-- Jobb oldal -->
                        <div class="col-md-6">
                            <div class="p-3 border rounded shadow-sm">
                                <h5 class="text-center">Időpontok és Kép</h5>

                                <div class="mb-3">
                                    <label for="kezdet" class="form-label">Kezdete</label>
                                    <input type="date" class="form-control" name="kezdet" value="{{ old('kezdet') }}"
                                        required>
                                    @error('kezdet') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="vege" class="form-label">Vége</label>
                                    <input type="date" class="form-control" name="vege" value="{{ old('vege') }}"
                                        required>
                                    @error('vege') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="link" class="form-label">Link</label>
                                    <input type="url" class="form-control" name="link" value="{{ old('link') }}"
                                        placeholder="Link (ha van)">
                                    @error('link') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kep" class="form-label">Program Képe</label>
                                    <input type="file" class="form-control" name="kep">
                                    @error('kep') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

                @foreach ($HelyiProgramajanlo as $program)
                    <div class="modal fade" id="programModal{{ $program->program_id }}" tabindex="-1"
                        aria-labelledby="programModalLabel{{ $program->program_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="programModalLabel{{ $program->program_id }}">Program
                                        Módosítása</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('Helyi.update', $program->program_id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="nev" class="form-label">Program neve</label>
                                            <input type="text" class="form-control" name="cim" value="{{ $program->cim }}"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="helyszin" class="form-label">Helyszín</label>
                                            <input type="text" class="form-control" name="helyszin"
                                                value="{{ $program->helyszin }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kezdet" class="form-label">Kezdet</label>
                                            <input type="date" class="form-control" name="kezdet"
                                                value="{{ $program->kezdet }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vege" class="form-label">Vége</label>
                                            <input type="date" class="form-control" name="vege" value="{{ $program->vege }}"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="leiras" class="form-label">Leírás</label>
                                            <input type="text" class="form-control" name="leiras"
                                                value="{{ $program->leiras }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="link" class="form-label">Link</label>
                                            <input type="text" class="form-control" name="link"
                                                value="{{ $program->link }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="kep" class="form-label">Program Képe</label>
                                            <input type="file" class="form-control" name="kep" value="{{ $program->kep }}">

                                            @if($program->kep)
                                                <div class="mt-2">
                                                    <strong>Jelenlegi kép: </strong> {{ $program->kep }}
                                                </div>
                                            @endif

                                            @error('kep')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Mégse</button>
                                            <button type="submit" class="btn btn-warning">Frissítés</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <link rel="stylesheet" href="{{'foglalasStyle.css'}}">
            <!-- Foglalás -->
            <div id="Foglalas" class="table-container">
                <div class="container my-5">

                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0"><i class="fa fa-calendar"></i> Foglalás</h3>
                        </div>
            
                        <div class="card-body">
                            <form action="{{ route('foglalas.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-lg-6 col-md-12 mb-4">
                                        <div class="booking-calendar mb-4" id="booking-calendar"></div>
            
                                        <input type="hidden" id="checkin" name="checkin">
                                        <input type="hidden" id="checkout" name="checkout">
            
            
            
                                        <div class="mb-3">
                                            <label class="form-label">Érkezés dátuma</label>
                                            <input type="date" class="form-control foglalas-input" name="erkezes">
                                               
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Távozás dátuma</label>
                                            <input type="date" class="form-control foglalas-input" name="tavozas">
                                              
                                        </div>
            
                                        <p class="errorParagraph alert alert-danger d-none"></p>
                                        <div id="messages-container"></div>
            
            
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="fa fa-user"></i> Felnőtt</label>
                                                <select class="form-select" id="felnott" name="felnott">
                                                    <option selected value="0">0</option>
                                                    @for ($i = 1; $i <= 4; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
            
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="fa fa-child"></i> Gyerek</label>
                                                <select class="form-select" id="gyerek" name="gyerek">
                                                    <option selected value="0">0</option>
                                                    @for ($i = 1; $i <= 4; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
            
                                        <div class="mb-4">
                                            <label for="specialis_keresek" class="form-label"><i class="fa fa-comment"></i>
                                                Speciális kérések:</label>
                                            <textarea class="form-control" id="specialis_keresek" name="specialis_keresek"
                                                rows="4"></textarea>
                                        </div>
            
                                        <div class="alert alert-info">
                                            <h5 class="mb-0" id="calculatedPrice">Válassza ki a dátumot és a vendégek számát az ár
                                                megjelenítéséhez</h5>
                                        </div>
                                    </div>
            
                                    <!-- Right Column -->
                                    <div class="col-lg-6 col-md-12">
                                        <h4 class="mb-4"><i class="fa fa-user-circle"></i> Vendég adatai</h4>
            
                                        <div class="mb-3">
                                            <label for="nev" class="form-label"><i class="fa fa-user"></i> Név*</label>
                                            <input type="text" class="form-control" id="nev" name="nev" required>
                                        </div>
            
                                        <div class="mb-3">
                                            <label for="email" class="form-label"><i class="fa fa-envelope"></i> Email*</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
            
                                        <div class="mb-3">
                                            <label for="telefon" class="form-label"><i class="fa fa-phone"></i> Telefon</label>
                                            <input type="tel" class="form-control" id="telefon" name="telefon">
                                        </div>
            
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label for="iranyitoszam" class="form-label"><i class="fa fa-map-pin"></i>
                                                    Irányítószám</label>
                                                <input type="text" class="form-control" id="iranyitoszam" name="iranyitoszam">
                                            </div>
                                            <div class="col-md-8">
                                                <label for="lakcim" class="form-label"><i class="fa fa-map-marker"></i>
                                                    Lakcím</label>
                                                <input type="text" class="form-control" id="lakcim" name="lakcim">
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label"><i class="fa fa-gift"></i> Érkezési csomagok
                                                (opcionális)</label>
                                            <div class="csomagok-container">
                                                @foreach(App\Models\ErkezesiCsomag::where('elerheto', '>', 0)->get() as $csomag)
                                                    <div class="form-check csomag-card">
                                                        <input class="form-check-input csomag-checkbox" type="checkbox" name="csomagok[]"
                                                            value="{{ $csomag->csomag_id }}" id="csomag-{{ $csomag->csomag_id }}"
                                                            data-ar="{{ $csomag->ar }}">
                                                        <label class="form-check-label" for="csomag-{{ $csomag->csomag_id }}">
                                                            <div class="csomag-info">
                                                                <div class="d-flex justify-content-between">
                                                                    <span class="csomag-name">{{ $csomag->nev }}</span>
                                                                    <span class="csomag-price">{{ number_format($csomag->ar, 0, ',', ' ') }} Ft</span>
                                                                </div>
                                                                @if($csomag->leiras)
                                                                    <div class="csomag-desc">{{ $csomag->leiras }}</div>
                                                                @endif
                                                            </div>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- Payment Section -->
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <label class="form-label"><i class="fa fa-credit-card"></i> Fizetési mód*</label>
                                                <div class="payment-options">
                                                    <div class="payment-option" id="bank-transfer">
                                                        <div class="payment-icon">
                                                            <i class="fas fa-money-bill-wave"></i>
                                                        </div>
                                                        <div class="payment-label">Azonnali utalás</div>
                                                    </div>
                                                    <div class="payment-option" id="credit-card">
                                                        <div class="payment-icon">
                                                            <i class="far fa-credit-card"></i>
                                                        </div>
                                                        <div class="payment-label">Bankkártya</div>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="payment-method" name="payment_method" required>
                                            </div>
                                        </div>
            
                                        <!-- Bank Transfer Details (shown when bank transfer is selected) -->
                                        <div id="bank-transfer-details" class="payment-details mb-3 d-none">
                                            <div class="alert alert-info">
                                                <h5><i class="fas fa-info-circle"></i> Fizetési utasítások</h5>
                                                <p>Kérjük, utalja a foglalási díj 50%-át (<span id="deposit-amount">0</span> Ft) az
                                                    alábbi számlaszámra:</p>
                                                <p><strong>Bankszámlaszám:</strong> 33345678-12345333-00000000</p>
                                                <p><strong>Kedvezményezett:</strong> Andi Apartman Kft.</p>
                                                <p>A maradék összeget a szálláshelyen kell rendeznie.</p>
                                            </div>
                                        </div>
            
                                        <!-- Credit Card Form (shown when credit card is selected) -->
                                        <div id="credit-card-form" class="payment-details mb-3 d-none">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <h5><i class="far fa-credit-card"></i> Bankkártya adatai</h5>
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <label for="card-number" class="form-label">Kártyaszám*</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="far fa-credit-card"></i></span>
                                                                <input type="text" class="form-control" id="card-number"
                                                                    placeholder="1234 5678 9012 3456" maxlength="19">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="card-name" class="form-label">Név a kártyán*</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="far fa-user"
                                                                        id="secretTrigger"></i></span>
                                                                <input type="text" class="form-control" id="card-name"
                                                                    placeholder="Benjamin Reichwald">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="card-expiry" class="form-label">Lejárat*</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i
                                                                        class="far fa-calendar-alt"></i></span>
                                                                <input type="text" class="form-control" id="card-expiry"
                                                                    placeholder="MM/ÉÉ" maxlength="5">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="card-cvv" class="form-label">CVV*</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                                <input type="password" class="form-control" id="card-cvv"
                                                                    placeholder="123" maxlength="3">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <img src="img/simplepay.png" alt="Secure payment" class="img-fluid"
                                                            style="max-height: 150px;">
                                                        <p class="small text-muted mt-2"><i class="fas fa-lock"></i> Az adatai
                                                            biztonságban vannak</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="d-grid mt-4">
                                            <button type="submit" class="btn btn-primary btn-lg py-3">
                                                <i class="fa fa-paper-plane"></i> Foglalás elküldése
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="footer">
                <p class="text-left" style="font-size: x-large">&copy; 2025 Admin Felület | Minden jog fenntartva |
                    Készitette Takács Áron</p>
            </div>
        </div>
        <style>
            .modal-backdrop {
                background-color: rgba(0, 0, 0, 0.3) !important;
            }
        </style>
        <script>
            function showSection(sectionId) {
                document.querySelectorAll('.table-container').forEach(div => div.style.display = 'none');
                document.getElementById(sectionId).style.display = 'block';
            }

        </script>

        <script>
            ocument.addEventListener("DOMContentLoaded", function () {
                const checkinInput = document.getElementById("checkin");
                const checkoutInput = document.getElementById("checkout");
                const felnottInput = document.getElementById("felnott");
                const gyerekInput = document.getElementById("gyerek");
                const csomagSelect = document.getElementById("csomag_id");
                const akcioSelect = document.getElementById("akcio_id");
                const totalDisplay = document.getElementById("total-amount");

                const csomagok = JSON.parse(document.getElementById("csomag-data").textContent);
                const akciok = JSON.parse(document.getElementById("akcio-data").textContent);

                function calculateTotal() {
                    const checkinDate = new Date(checkinInput.value);
                    const checkoutDate = new Date(checkoutInput.value);

                    if (isNaN(checkinDate) || isNaN(checkoutDate) || checkinDate >= checkoutDate) {
                        totalDisplay.textContent = "Hibás dátum!";
                        return;
                    }

                    const nights = (checkoutDate - checkinDate) / (1000 * 60 * 60 * 24);
                    const felnottCount = parseInt(felnottInput.value) || 0;
                    const gyerekCount = parseInt(gyerekInput.value) || 0;
                    const csomagId = csomagSelect.value;
                    const akcioId = akcioSelect.value;

                    const csomag = csomagok.find(c => c.id == csomagId);
                    const akcio = akciok.find(a => a.id == akcioId);

                    if (!csomag) {
                        totalDisplay.textContent = "Nincs kiválasztott csomag!";
                        return;
                    }

                    let total = (felnottCount * csomag.ar + gyerekCount * (csomag.ar * 0.5)) * nights;

                    if (akcio) {
                        total -= total * (akcio.kedvezmeny_szazalek / 100);
                    }

                    totalDisplay.textContent = `Összeg: ${total.toLocaleString("hu-HU")} Ft`;
                }

                [checkinInput, checkoutInput, felnottInput, gyerekInput, csomagSelect, akcioSelect].forEach(element => {
                    element.addEventListener("change", calculateTotal);
                });

                calculateTotal(); // Induláskor is számolja ki az értéket
            });
        </script>
        <script src="{{asset('foglalasScript')}}"></script>
</body>

</html>
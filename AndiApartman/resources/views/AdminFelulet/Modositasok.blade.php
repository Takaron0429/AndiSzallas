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
        body {
            background-color: rgb(243, 242, 242);
        }

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
    </style>
    <title>Modósitás</title>
</head>

<body>

    <div class="container mt-4">
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

        <div class="container">
            <div class="row category-buttons text-center">
                <div class="col"><button class="btn btn-primary" onclick="showSection('csomag')">Csomagok</button></div>
                <div class="col"><button class="btn btn-success" onclick="showSection('akcio')">Akciók</button></div>
                <div class="col"><button class="btn btn-warning" onclick="showSection('program')">Programok</button>
                </div>
                <div class="col"><button class="btn btn-danger" onclick="showSection('Foglalas')">Foglalás</button>
                </div>
            </div>

            <!-- Csomagok -->
            <div id="csomag" class="table-container">
                <h3>Csomagok</h3>
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

            <!-- Akciók -->
            <div id="akcio" class="table-container" style="display: none;">
                <h3>Akciók</h3>
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

            <div id="program" class="table-container" style="display: block;">
                <h3>Programok</h3>
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
                                
                                </td>
                                <td>
                                    <!-- Módosítás gomb -->
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#programModal{{ $program->program_id }}">Módosítás</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Modal a program módosításához -->
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
                                            @error('nev')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="helyszin" class="form-label">Helyszín</label>
                                            <input type="text" class="form-control" name="helyszin"
                                                value="{{ $program->helyszin }}" required>
                                            @error('helyszin')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="kezdet" class="form-label">Kezdet</label>
                                            <input type="date" class="form-control" name="kezdet"
                                                value="{{ $program->kezdet }}" required>
                                            @error('kezdet')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="vege" class="form-label">Vége</label>
                                            <input type="date" class="form-control" name="vege" value="{{ $program->vege }}"
                                                required>
                                            @error('vege')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="leiras" class="form-label">Leírás</label>
                                            <input type="text" class="form-control" name="leiras"
                                                value="{{ $program->leiras }}">
                                            @error('leiras')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="link" class="form-label">Link</label>
                                            <input type="url" class="form-control" name="link" value="{{ $program->link }}">
                                            @error('link')
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

                <!-- Program hozzáadása űrlap -->
                <form class="form-container" action="{{ route('Helyi.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nev" class="form-label">Program neve</label>
                        <input type="text" class="form-control" name="cim" value="{{ old('cim') }}"
                            placeholder="Program neve" required>
                        @error('nev')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="helyszin" class="form-label">Helyszín</label>
                        <input type="text" class="form-control" name="helyszin" value="{{ old('helyszin') }}"
                            placeholder="Helyszín" required>
                        @error('helyszin')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kezdet" class="form-label">Kezdete</label>
                        <input type="date" class="form-control" name="kezdet" value="{{ old('kezdet') }}" required>
                        @error('kezdet')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="vege" class="form-label">Vége</label>
                        <input type="date" class="form-control" name="vege" value="{{ old('vege') }}" required>
                        @error('vege')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="leiras" class="form-label">Leírás</label>
                        <textarea class="form-control" name="leiras"
                            placeholder="Program leírása">{{ old('leiras') }}</textarea>
                        @error('leiras')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link</label>
                        <input type="url" class="form-control" name="link" value="{{ old('link') }}"
                            placeholder="Link (ha van)">
                        @error('link')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-warning">Hozzáadás</button>
                </form>
            </div>
        </div>

        <div id="Foglalas" class="table-container">
            <br>
            <hr>
            <h3>Foglalás Adatok</h3>
            <hr>
            <br>
            <style>
                #foglalas {
                    margin-top: 30px;
                }

                .form-section {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
                    margin-bottom: 20px;
                }

                label {
                    font-weight: bold;
                    color: #333;
                }

                input,
                select,
                textarea {
                    width: 100%;
                    padding: 10px;
                    margin: 10px 0;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    font-size: 1rem;
                }

                textarea {
                    resize: vertical;
                }

                button {
                    padding: 12px 20px;
                    background-color: #ff8c00;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    font-size: 1.2rem;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                }

                button:hover {
                    background-color: #e07b00;
                }


                @media (max-width: 768px) {
                    #foglalas .form-container {
                        padding: 0 15px;
                    }

                    .col-lg-6 {
                        width: 100%;
                        margin-bottom: 20px;
                    }

                    button {
                        width: 100%;
                    }

                    .form-select,
                    input,
                    textarea {
                        font-size: 1rem;
                    }
                }


                @media (max-width: 576px) {
                    .form-section {
                        padding: 15px;
                    }

                    button {
                        font-size: 1.1rem;
                    }
                }
            </style>
            <form class="form-container" action="{{ route('foglalas.Adminstore') }}" method="POST">
                @csrf
                <div class="row">

                    <div class="col-lg-6 col-md-12">
                        <section class="form-section">
                            <label for="checkin"><i class="fa-solid fa-calendar-days"></i> Bejelentkezés:</label>
                            <input type="date" id="checkin" name="checkin" class="form-control mb-2" required>

                            <label for="checkout"><i class="fa-solid fa-calendar-days"></i> Kijelentkezés:</label>
                            <input type="date" id="checkout" name="checkout" class="form-control mb-2" required>

                            <label for="felnott"><i class="fa-solid fa-person"></i> Felnőtt</label>
                            <select class="form-select mb-2" id="felnott" name="felnott" required>
                                <option selected>0</option>
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>

                            <label for="gyerek"><i class="fa-solid fa-child-reaching"></i> Gyermek</label>
                            <select class="form-select mb-2" id="gyerek" name="gyerek" required>
                                <option selected>0</option>
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>

                            <label for="csomag"><i class="fa-solid fa-box"></i> Csomag</label>
                            <select class="form-select mb-2" id="csomag" name="csomag_id" required>
                                <option selected value="">Válassz csomagot</option>
                                @foreach ($Csomag as $csomag)
                                    <option value="{{ $csomag->id }}" data-ar="{{ $csomag->ar }}">{{ $csomag->nev }}
                                    </option>
                                @endforeach
                            </select>

                            <label for="akcio"><i class="fa-solid fa-tags"></i> Akció</label>
                            <select class="form-select mb-2" id="akcio" name="akcio_id">
                                <option selected value="">Válassz akciót</option>
                                @foreach ($Akcio as $akcio)
                                    <option value="{{ $akcio->id }}" data-kedvezmeny="{{ $akcio->kedvezmeny_szazalek }}">
                                        {{ $akcio->cim }}
                                    </option>
                                @endforeach
                            </select>

                            <label for="specialis_keresek">Speciális kérések:</label>
                            <textarea id="specialis_keresek" name="specialis_keresek" class="form-control mb-2"
                                rows="4"></textarea>
                        </section>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <section class="form-section">
                            <label for="nev"><i class="fa-solid fa-address-card"></i> Név:</label>
                            <input type="text" name="nev" class="form-control mb-2" required>

                            <label for="email"><i class="fa-solid fa-envelope"></i> Email:</label>
                            <input type="email" name="email" class="form-control mb-2" required>

                            <label for="telefon"><i class="fa-solid fa-phone"></i> Telefon:</label>
                            <input type="text" name="telefon" class="form-control mb-2">

                            <label for="iranyitoszam"><i class="fa-solid fa-location-dot"></i> Irányítószám:</label>
                            <input type="text" name="iranyitoszam" class="form-control mb-2">

                            <label for="lakcim"><i class="fa-solid fa-location-dot"></i> Lakcím:</label>
                            <input type="text" name="lakcim" class="form-control mb-2">

                            <button type="submit" class="btn btn-primary mt-3">Foglalás elküldése</button>
                        </section>
                    </div>
                </div>
                <div>
                    <h5>Összeg: <span id="total-amount">0 Ft</span></h5>
                </div>
            </form>

        </div>
        <div class="footer">
            <p class="text-left" style="font-size: x-large">&copy; 2025 Admin Felület | Minden jog fenntartva |
                Készitette Takács Áron</p>
        </div>
    </div>


    </div>
    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.table-container').forEach(el => el.style.display = 'none');
            document.getElementById(sectionId).style.display = 'block';
        }
        document.addEventListener("DOMContentLoaded", function () {
            const felnottInput = document.getElementById("felnott");
            const gyerekInput = document.getElementById("gyerek");
            const csomagSelect = document.getElementById("csomag");
            const akcioSelect = document.getElementById("akcio");
            const totalAmountSpan = document.getElementById("total-amount");

            function updateTotalAmount() {
                const felnottSzam = parseInt(felnottInput.value) || 0;
                const gyerekSzam = parseInt(gyerekInput.value) || 0;
                const csomagAr = parseInt(csomagSelect.options[csomagSelect.selectedIndex].dataset.ar) || 0;
                const akcioSzazalek = parseInt(akcioSelect.options[akcioSelect.selectedIndex]?.dataset.kedvezmeny) || 0;

                const checkin = new Date(document.getElementById("checkin").value);
                const checkout = new Date(document.getElementById("checkout").value);
                const napokSzama = (checkout - checkin) / (1000 * 60 * 60 * 24) || 1;

                let total = (felnottSzam * csomagAr + gyerekSzam * csomagAr * 0.5) * napokSzama;

                if (akcioSzazalek > 0) {
                    total -= total * (akcioSzazalek / 100);
                }

                totalAmountSpan.textContent = total.toLocaleString("hu-HU") + " Ft";
            }

            felnottInput.addEventListener("change", updateTotalAmount);
            gyerekInput.addEventListener("change", updateTotalAmount);
            csomagSelect.addEventListener("change", updateTotalAmount);
            akcioSelect.addEventListener("change", updateTotalAmount);
            document.getElementById("checkin").addEventListener("change", updateTotalAmount);
            document.getElementById("checkout").addEventListener("change", updateTotalAmount);
        });
    </script>
</body>

</html>
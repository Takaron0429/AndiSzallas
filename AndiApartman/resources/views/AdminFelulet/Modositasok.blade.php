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
        body{
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
                <div class="col"><button class="btn btn-danger" onclick="showSection('Foglalás')">Foglalás</button>
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
                                <form action="{{ route('Erkezesi.update' , $csomag->csomag_id) }}" method="POST">
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
                            <th>Kép</th>
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
                                <td><img src="{{ asset('kepek/' . $program->kep) }}" alt="{{ $program->kep }}"
                                        width="100"></td>
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
                                    <h5 class="modal-title" id="programModalLabel{{ $program->program_id }}">Program Módosítása</h5>
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
                                        <div class="mb-3">
                                            <label for="kep" class="form-label">Kép</label>
                                            <input type="file" class="form-control" name="kep" accept="image/*">
                                            @error('kep')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="mt-2">
                                                @if ($program->kep)
                                                    <img src="{{ asset('storage/' . $program->kep) }}" alt="Program Kép"
                                                        width="100">
                                                @endif
                                            </div>
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
                    <div class="mb-3">
                        <label for="kep" class="form-label">Kép</label>
                        <input type="file" class="form-control" name="kep" accept="image/*" required>
                        @error('kep')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-warning">Hozzáadás</button>
                </form>
            </div>
        </div>
        <div class="footer">
            <p class="text-left" style="font-size: x-large">&copy; 2025 Admin Felület | Minden jog fenntartva | Készitette Takács Áron</p>
        </div>
    </div>
    <script>
        function showSection(sectionId) {
            document.querySelectorAll('.table-container').forEach(el => el.style.display = 'none');
            document.getElementById(sectionId).style.display = 'block';
        }
    </script>
</body>

</html>
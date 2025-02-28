<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('AdminLogin.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminMod.css') }}">
    
    <title>Modósitás</title>
</head>

<body>
    <div class="container-fluid">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="">Admin#Felület</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="">Módosítások</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Kategória Gombok -->
        <div class="container  ">
            <div class="row category-buttons text-center">
                <div class="col"><button class="btn btn-primary" onclick="showSection('csomag')">Csomagok</button></div>
                <div class="col"><button class="btn btn-success" onclick="showSection('akcio')">Akciók</button></div>
                <div class="col"><button class="btn btn-warning" onclick="showSection('program')">Programok</button>
                </div>
                <div class="col"><button class="btn btn-danger" onclick="showSection('fizetes')">Fizetés</button></div>
            </div>
            >
            <div id="csomag" class="table-container">
                <h3>Csomagok</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Név</th>
                            <th>Leírás</th>
                            <th>Ár</th>
                            <th>Elérhető</th>
                        </tr>
                    </thead>
                    <tbody class="w-100">
                        @foreach ($ErkezesiCsomag as $csomag)
                            <tr>
                                <td>{{ $csomag->nev }}</td>
                                <td>{{ $csomag->leiras }}</td>
                                <td>{{ $csomag->ar }} Ft</td>
                                <td>{{ $csomag->elerheto }}</td>
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


            <div id="akcio" class="table-container" style="display: none;">
                <h3>Akciók</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Név</th>
                            <th>Kedvezmény</th>
                            <th>Leírás</th>
                            <th>Kezdete</th>
                            <th>Vége</th>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <form class="form-container" action="{{ route('Akcio.store') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success w-25">Hozzáadás</button>
                    <input type="text" class="form-control mb-2" name="cim" placeholder="Akció neve" required>
                    <input type="number" class="form-control mb-2" name="kedvezmeny_szazalek" placeholder="Kedvezmény %"
                        required>
                    <textarea type="text" class="form-control mb-2" name="leiras" placeholder="Leírás"></textarea>
                    <input type="date" class="form-control mb-2" name="kezdete" required>
                    <input type="date" class="form-control mb-2" name="vege" required>
                    <br>

                    <br>
                </form>
            </div>
            <br>
            <!-- Programok -->
            <div id="program" class="table-container" style="display: none;">
                <h3>Programok</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cím</th>
                            <th>Helyszín</th>
                            <th>Kezdés</th>
                            <th>Befejezés</th>
                            <th>Link</th>
                            <th>Fotó</th>
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
                                    <img src="{{ asset('storage/programok/' . $program->kep) }}" alt="Program képe"
                                        width="100">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <form class="form-container" action="{{ route('Helyi.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control mb-2" name="cim" placeholder="Program címe" required>
                    <input type="text" class="form-control mb-2" name="helyszin" placeholder="Helyszín" required>
                    <input type="datetime-local" class="form-control mb-2" name="kezdet" required>
                    <input type="datetime-local" class="form-control mb-2" name="vege" required>
                    <input type="url" class="form-control mb-2" name="link" placeholder="További információ link">
                    <input type="file" class="form-control mb-2" name="kep" required>
                    <button type="submit" class="btn btn-warning">Hozzáadás</button>
                </form>
            </div>
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
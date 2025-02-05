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
        <nav class="navbar navbar-expand-lg fixed-top bg-orange  custom-navbar col-12">
            <div class="container color:white">
                <a class="navbar-brand" href="#">Admin#Felület</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse fade" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Foglalások</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Új foglalás</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Modósitások</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-danger text-white px-3" href="#">Kijelentkezés</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container mt-4">
            <div class="row category-buttons text-center">
                <div class="col"><button class="btn btn-primary" onclick="showSection('csomag')">Csomagok</button></div>
                <div class="col"><button class="btn btn-success" onclick="showSection('akcio')">Akciók</button></div>
                <div class="col"><button class="btn btn-warning" onclick="showSection('program')">Programok</button>
                </div>
                <div class="col"><button class="btn btn-danger" onclick="showSection('fizetes')">Fizetés</button></div>
            </div>

            <div id="csomag" class="table-container">
                <h3>Csomagok</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Név</th>
                            <th>Leírás</th>
                            <th>Ár</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Luxus Csomag</td>
                            <td>5 csillagos élmény</td>
                            <td>500€</td>
                        </tr>
                        <tr>
                            <td>Luxus Csomag</td>
                            <td>5 csillagos élmény</td>
                            <td>500€</td>
                        </tr>
                         <tr>
                            <td>Luxus Csomag</td>
                            <td>5 csillagos élmény</td>
                            <td>500€</td>
                        </tr>
                    </tbody>
                </table>
                <form class="form-container">
                    <input type="text" class="form-control mb-2" placeholder="Csomag neve">
                    <textarea class="form-control mb-2" placeholder="Leírás"></textarea>
                    <input type="number" class="form-control mb-2" placeholder="Ár">
                    <button class="btn btn-primary">Hozzáadás</button>
                </form>
            </div>

            <div id="akcio" class="table-container">
                <h3>Akciók</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Név</th>
                            <th>Kedvezmény</th>
                            <th>Leírás</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hétvégi Akció</td>
                            <td>20%</td>
                            <td>Minden foglalásra</td>
                        </tr>
                    </tbody>
                </table>
                <form class="form-container">
                    <input type="text" class="form-control mb-2" placeholder="Akció neve">
                    <input type="text" class="form-control mb-2" placeholder="Kedvezmény">
                    <textarea class="form-control mb-2" placeholder="Leírás"></textarea>
                    <button class="btn btn-success">Hozzáadás</button>
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
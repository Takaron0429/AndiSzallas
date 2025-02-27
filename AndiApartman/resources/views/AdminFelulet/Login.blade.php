<!DOCTYPE html>
<<html lang="hu">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Bejelentkezés</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- FontAwesome -->
        <style>
            /* Háttér és gradient színek */
            body {
                margin: 0;
                padding: 0;
                height: 100vh;
                background: url('{{ asset('kepek/szemeswide.jpg') }}') no-repeat center center fixed;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            /* A login form konténer formázása */
            .login-container {
                background: rgba(5, 5, 5, 0.8);
                border-radius: 12px;
                padding: 30px;
                box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 400px;
                text-align: center;
                z-index: 10;
             
            }

            /* Ikon a login formában */
            .login-container i {
                font-size: 50px;
                color: #2575fc;
                margin-bottom: 20px;
            }

            /* Címek formázása */
            .login-container h3 {
                font-size: 24px;
                margin-bottom: 20px;
                color: #2575fc;
            }

            /* A form és mezők stílusa */
            .form-label {
                font-weight: bold;
                color: white
            }

            .form-control {
                border-radius: 8px;
                padding: 12px;
                border: 1px solid #ccc;
            }

            .form-control:focus {
                border-color: #2575fc;
                box-shadow: 0 0 10px rgba(37, 117, 252, 0.5);
            }

            /* A gomb stílusa */
            .btn-primary {
                background-color: #2575fc;
                border-color: #2575fc;
                padding: 12px;
                font-weight: bold;
                width: 100%;
                border-radius: 8px;
            }

            .btn-primary:hover {
                background-color: #1a5fa7;
                border-color: #1a5fa7;
            }

            /* A hibaüzenetek stílusa */
            .alert-danger {
                color: #d9534f;
                background-color: #f8d7da;
                border-color: #f5c6cb;
            }

            /* A kis mobilokra való reszponzív formázás */
            @media (max-width: 576px) {
                .login-container {
                    padding: 20px;
                    width: 90%;
                }

                .login-container h3 {
                    font-size: 20px;
                }
            }
        </style>
    </head>

    <body>
        <!-- Login Form -->
        <div class="login-container">
            <i class="fas fa-lock"></i>
            <h3>Admin Bejelentkezés</h3>
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="mb-3">
                    <label for="felhasznalonev" class="form-label">Felhasználónév</label>
                    <input type="text" name="felhasznalonev" id="felhasznalonev" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail cím</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="jelszo" class="form-label">Jelszó</label>
                    <input type="password" name="jelszo" id="jelszo" class="form-control" required>
                </div>

                <!-- Hibaüzenet -->
                @if ($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <!-- Bejelentkezés gomb -->
                <button type="submit" class="btn btn-primary">Bejelentkezés</button>
            </form>
        </div>

    </body>

    </html>
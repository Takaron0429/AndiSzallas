<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Bejelentkezés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="{{ asset('AdminLog.css') }}">

    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: url('{{ asset('kepek/szemeswide.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #222;
            text-align: center;
            position: relative;
        }
    </style>
</head>

<body>

    <div class="content">

        <div class="header">
            <h1>Üdvözlünk az Admin Panelen!</h1>
            <p>Jelentkezz be az adminisztrációs felület eléréséhez és a rendszer kezeléséhez.</p>
        </div>

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
                <div class="mb-3 password-container">
                    <label for="jelszo" class="form-label">Jelszó</label>
                    <input type="password" name="jelszo" id="jelszo" class="form-control" required>
                    <i class="fas fa-eye" id="togglePassword"></i>
                </div>
                <br>
                <hr>
                <button type="submit" style="width: 75%;" class="btn btn-primary">Bejelentkezés</button>
            </form>


        </div>
    </div>

    <script>
        document.querySelector("#togglePassword").addEventListener("click", function () {
            const passwordInput = document.querySelector("#jelszo");
            passwordInput.type = passwordInput.type === "password" ? "text" : "password";
            this.classList.toggle("fa-eye-slash");
        });
    </script>

</body>

</html>
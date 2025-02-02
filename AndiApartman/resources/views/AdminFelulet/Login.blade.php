<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Bejelentkezés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('AdminLogin.css') }}">
</head>
<body>
    <div class="login-container">
        <i class="fas fa-lock text-center"></i>
        <h3 class="text-center">Admin Bejelentkezés</h3>
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
            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif
            <button type="submit" class="btn btn-primary w-100">Bejelentkezés</button>
        </form>
    </div>
    
</body>
</html>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Felület</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center">Üres Admin Felület</h3>
        <p class="text-center">Ez az üres admin felület, kérlek jelentkezz be!</p>
        <div class="text-center">
            <a href="{{ route('admin.login') }}" class="btn btn-info">Bejelentkezés</a>
        </div>
    </div>
</body>
</html>
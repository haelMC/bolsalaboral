<!-- resources/views/auth/pending-approval.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendiente de Aprobación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="text-center">
        <h1 class="display-4">Tu cuenta está pendiente de aprobación</h1>
        <p class="lead">Un administrador revisará tu cuenta y te notificaremos cuando esté lista para acceder.</p>
        <a href="{{ route('login') }}" class="btn btn-primary mt-3">Volver al inicio de sesión</a>
    </div>
</body>
</html>

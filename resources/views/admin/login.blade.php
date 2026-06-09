<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador</title>
</head>
<body>

<h1>Panel Administrador</h1>

@if(session('error'))
    <p style="color:red;">
        {{ session('error') }}
    </p>
@endif

<form method="POST" action="{{ route('admin.validar') }}">
    @csrf

    <div>
        <label>Usuario</label>
        <input type="text" name="usuario" required>
    </div>

    <br>

    <div>
        <label>Contraseña</label>
        <input type="password" name="password" required>
    </div>

    <br>

    <button type="submit">
        Ingresar
    </button>
</form>

</body>
</html>
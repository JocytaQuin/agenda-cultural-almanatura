<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inscripción</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f2ef;
            padding: 40px;
            color: #2c2c2c;
        }

        .contenedor {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        h1 {
            color: #5e1541;
            font-size: 36px;
        }

        label {
            display: block;
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 16px;
            margin-top: 8px;
            font-size: 18px;
            border: 1px solid #ccc;
            border-radius: 12px;
        }

        button {
            margin-top: 30px;
            background: #5e1541;
            color: white;
            border: none;
            padding: 16px 24px;
            border-radius: 12px;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #5e1541;
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h1>Inscripción</h1>

    <p>Evento: <strong>{{ $evento->nombre }}</strong></p>

    <form method="POST" action="/evento/{{ $evento->id }}/inscripcion">
        @csrf

        <label>Nombre</label>
        <input type="text" name="nombre" required>

        <label>Apellido</label>
        <input type="text" name="apellido" required>

        <label>Teléfono</label>
        <input type="text" name="telefono" required>

        <button type="submit">Me interesa</button>
    </form>

    <a href="/evento/{{ $evento->id }}">Volver al evento</a>

</div>

</body>
</html>
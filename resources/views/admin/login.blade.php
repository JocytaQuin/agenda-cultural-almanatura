<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador</title>

    <style>
        :root {
            --fondo: #a8a198;
            --principal: #6b0f45;
            --blanco: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background-color: var(--fondo);
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background-color: var(--blanco);
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18);
            text-align: center;
        }

        .login-logo {
            width: 210px;
            margin-bottom: 25px;
        }

        h1 {
            color: var(--principal);
            font-size: 28px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #555;
            font-size: 15px;
            margin-bottom: 28px;
        }

        label {
            display: block;
            text-align: left;
            color: var(--principal);
            font-weight: bold;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #ccc;
            border-radius: 9px;
            margin-bottom: 18px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: var(--principal);
        }

        button {
            width: 100%;
            background-color: var(--principal);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 999px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.9;
        }

        .error {
            background-color: #ffe5e5;
            color: #9b1c1c;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: var(--principal);
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        @media (max-width: 480px) {
            .login-card {
                margin: 20px;
                padding: 30px 24px;
            }

            .login-logo {
                width: 180px;
            }
        }
    </style>
</head>
<body>

<div class="login-card">

    <img src="{{ asset('img/logos/logo.png') }}" alt="AlmaNatura" class="login-logo">

    <h1>Panel Administrador</h1>
    <p class="subtitle">Gestión de eventos culturales</p>

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.validar') }}">
        @csrf

        <label>Usuario</label>
        <input type="text" name="usuario" required>

        <label>Contraseña</label>
        <input type="password" name="password" required>

        <button type="submit">
            Ingresar
        </button>
    </form>

    <a href="{{ route('agenda.index') }}" class="back-link">
        Volver a la Agenda Cultural
    </a>

</div>

</body>
</html>
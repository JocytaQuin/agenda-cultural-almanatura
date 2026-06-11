<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Evento</title>

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
            background-color: var(--fondo);
            font-family: Arial, Helvetica, sans-serif;
            padding: 40px;
        }

        .form-container {
            max-width: 850px;
            margin: 0 auto;
            background: var(--blanco);
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 12px 35px rgba(0,0,0,0.18);
        }

        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            color: var(--principal);
            margin: 0;
            font-size: 32px;
        }

        .logo {
            width: 180px;
        }

        label {
            display: block;
            color: var(--principal);
            font-weight: bold;
            margin-bottom: 6px;
        }

        input, textarea {
            width: 100%;
            padding: 13px;
            border: 1px solid #ccc;
            border-radius: 9px;
            font-size: 15px;
            margin-bottom: 18px;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: var(--principal);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .full {
            grid-column: 1 / -1;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        .btn-save {
            background-color: var(--principal);
            color: white;
            border: none;
            padding: 13px 24px;
            border-radius: 999px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-back {
            background-color: #e6e0e3;
            color: var(--principal);
            padding: 13px 24px;
            border-radius: 999px;
            text-decoration: none;
            font-weight: bold;
        }

        @media (max-width: 700px) {
            body {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .logo {
                width: 160px;
            }
        }
    </style>
</head>
<body>

<div class="form-container">

    <div class="form-header">
        <div>
            <h1>Crear Evento</h1>
            <p>Registra una nueva actividad cultural en la Agenda AlmaNatura.</p>
        </div>

        <img src="{{ asset('img/logos/logo.png') }}" alt="AlmaNatura" class="logo">
    </div>

    <form action="{{ route('admin.eventos.guardar') }}" method="POST">
        @csrf

        <div class="form-grid">

            <div class="full">
                <label>Nombre del evento</label>
                <input type="text" name="nombre" required>
            </div>

            <div class="full">
                <label>Descripción</label>
                <textarea name="descripcion" required></textarea>
            </div>

            <div>
                <label>Fecha</label>
                <input type="date" name="fecha" required>
            </div>

            <div>
                <label>Hora</label>
                <input type="time" name="hora" required>
            </div>

            <div>
                <label>Cupos</label>
                <input type="number" name="cupos" min="0" required>
            </div>

            <div>
                <label>Tipo de actividad</label>
                <input type="text" name="tipo_actividad" placeholder="Taller, Circo, Concierto" required>
            </div>

            <div class="full">
                <label>Imagen</label>
                <input type="text" name="imagen" placeholder="nombre-imagen.jpg" required>
            </div>

            <div class="full">
                <label>URL Google Form</label>
                <input type="text" name="google_sheet_url">
            </div>

            <div class="full">
                <label>URL Google Sheet</label>
                <input type="text" name="google_sheet_excel_url">
            </div>

            <div class="full">
                <label>URL CSV Google Sheets</label>
                <input type="text" name="google_sheet_csv_url">
            </div>

        </div>

        <div class="actions">
            <button type="submit" class="btn-save">
                Guardar Evento
            </button>

            <a href="{{ route('admin.eventos') }}" class="btn-back">
                Volver
            </a>
        </div>
    </form>

</div>

</body>
</html>
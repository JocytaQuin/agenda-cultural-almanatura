<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Eventos</title>

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

        .admin-container {
            max-width: 1300px;
            margin: 0 auto;
            background: var(--blanco);
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 12px 35px rgba(0,0,0,0.18);
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 20px;
        }

        .admin-title h1 {
            margin: 0;
            color: var(--principal);
            font-size: 32px;
        }

        .admin-title p {
            margin: 6px 0 0;
            color: #555;
        }

        .logo {
            width: 190px;
        }

        .btn-create {
            display: inline-block;
            background-color: var(--principal);
            color: white;
            padding: 12px 22px;
            border-radius: 999px;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .success {
            background-color: #e7f8ec;
            color: #1f7a3a;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background-color: var(--principal);
            color: white;
            padding: 14px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 13px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
            color: #333;
        }

        tr:hover {
            background-color: #f7f2f5;
        }

        .badge-ok {
            background-color: #e5f7e9;
            color: #247a37;
            padding: 5px 10px;
            border-radius: 999px;
            font-weight: bold;
            font-size: 13px;
            display: inline-block;
        }

        .badge-no {
            background-color: #fde5e5;
            color: #9b1c1c;
            padding: 5px 10px;
            border-radius: 999px;
            font-weight: bold;
            font-size: 13px;
            display: inline-block;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn-edit {
            background-color: #6b0f45;
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }

        .btn-participantes {
            background-color: #2563eb;
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }

        .btn-sheet {
            background-color: #15803d;
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            display: inline-block;
        }

        .btn-delete {
            background-color: #b91c1c;
            color: white;
            border: none;
            padding: 9px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
        }

        .back-link {
            display: inline-block;
            margin-top: 25px;
            color: var(--principal);
            text-decoration: none;
            font-weight: bold;
        }

        @media (max-width: 700px) {
            body {
                padding: 20px;
            }

            .admin-container {
                padding: 24px;
            }

            .admin-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .logo {
                width: 160px;
            }
        }
    </style>
</head>
<body>

<div class="admin-container">

    <div class="admin-header">
        <div class="admin-title">
            <h1>Administrar Eventos</h1>
            <p>Gestión de actividades culturales de AlmaNatura</p>
        </div>

        <img src="{{ asset('img/logos/logo.png') }}" alt="AlmaNatura" class="logo">
    </div>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.eventos.crear') }}" class="btn-create">
        + Crear nuevo evento
    </a>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Cupos</th>
                    <th>Inscritos</th>
                    <th>Disponibles</th>
                    <th>Estado</th>
                    <th>Vigencia</th>
                    <th>Google Sheet</th>
                    <th>CSV</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($eventos as $evento)
                    @php
                        $disponibles = $evento->cupos - $evento->participantes_count;
                    @endphp

                    <tr>
                        <td>{{ $evento->id }}</td>
                        <td>{{ $evento->nombre }}</td>
                        <td>{{ $evento->fecha }}</td>
                        <td>{{ $evento->hora }}</td>
                        <td>{{ $evento->cupos }}</td>
                        <td>{{ $evento->participantes_count }}</td>
                        <td>{{ $disponibles }}</td>

                       <td>
                            @if($disponibles > 0)
                                <span class="badge-ok">Disponible</span>
                        @else
                                <span class="badge-no">Completo</span>
                            @endif
                        </td>

                        <td>
                            @if(\Carbon\Carbon::parse($evento->fecha)->lt(\Carbon\Carbon::today()))
                                <span class="badge-no">Finalizado</span>
                            @else
                                <span class="badge-ok">Próximo</span>
                            @endif
                        </td>

                        <td>
                            @if($evento->google_sheet_excel_url)
                                <a href="{{ $evento->google_sheet_excel_url }}"
                            target="_blank"
                            class="btn-sheet">
                            Google Sheet
                                </a>
                            @else
                                <span class="badge-no">No</span>
                            @endif
                        </td>

                        <td>
                            @if($evento->google_sheet_csv_url)
                                <span class="badge-ok">Sí</span>
                            @else
                                <span class="badge-no">No</span>
                            @endif
                        </td>

                        <td>
                            <div class="actions">

                                <a href="{{ route('admin.eventos.participantes', $evento->id) }}"
                                   class="btn-participantes">
                                    Participantes
                                </a>

                                <a href="{{ route('admin.eventos.editar', $evento->id) }}"
                                   class="btn-edit">
                                    Editar
                                </a>

                                <form action="{{ route('admin.eventos.eliminar', $evento->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn-delete"
                                            onclick="return confirm('¿Seguro que deseas eliminar este evento?')">
                                        Eliminar
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ route('agenda.index') }}" class="back-link">
        Volver a la Agenda Cultural
    </a>

</div>

</body>
</html>
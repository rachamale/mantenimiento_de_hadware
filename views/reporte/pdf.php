<!DOCTYPE html>
<html>

<head>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            font-size: 32px;
            margin: 20px 0;
            color: #333;
        }

        .table {
            width: 100%;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
        }

        th {
            background-color: #333;
            color: #fff;
            font-size: 30px;
            font-weight: bold;
            text-align: left;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tbody tr:hover {
            background-color: #e0e0e0;
        }

        .data-label {
            font-weight: bold;
            font-size: 35px;
            color: #333;
        }

        .data-label::after {
            content: ":";
            margin-right: 5px;
        }

        .data-label,
        td {
            text-align: left;
        }

        .table tbody td,
        .table tbody th {
            border: 5px solid #555;
            border-spacing: 2;
        }

        .center-row th {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-5">Formulario de Entrega de Equipo</h1>

        <!-- Primera tabla -->
        <table class="table table-bordered table-striped mt-4">
            <tbody>
                <tr>
                    <td class="data-label" colspan="1">Fecha:</td>
                    <td colspan="2"><?= $equipo['equipo_fecha'] ?></td>
                    <td class="data-label" colspan="1">Registro:</td>
                    <td colspan="2"><?= $equipo['equipo_registro'] ?></td>
                </tr>
                <tr>
                    <th colspan="12">Oficio:</th>
                </tr>
                <tr>
                    <td class="data-label">Catálogo del Usuario:</td>
                    <td><?= $equipo['equipo_usuario_catalogo'] ?></td>
                    <td class="data-label">Nombre del Usuario:</td>
                    <td><?= $equipo['equipo_usuario_nombre'] ?></td>
                    <td class="data-label">Teléfono:</td>
                    <td><?= $equipo['equipo_telefono_usuario'] ?></td>
                </tr>
                <tr>
                    <th colspan="12">Dependencia:</th>
                </tr>
                <tr>
                    <td class="data-label" colspan="1">Catálogo del técnico entrega:</td>
                    <td colspan="2"><?= $equipo['equipo_tecnico_entrega'] ?></td>
                    <td class="data-label" colspan="1">Nombre del técnico:</td>
                    <td colspan="2"><?= $equipo['equipo_usuario_nombre'] ?></td>
                </tr>
                <tr class="center-row">
                    <th colspan="12">Características del Equipo</th>
                </tr>
                <tr>
                    <td class="data-label">Marca:</td>
                    <td><?= $equipo['equipo_marca'] ?></td>
                    <td class="data-label">Modelo:</td>
                    <td><?= $equipo['equipo_modelo'] ?></td>
                    <td class="data-label">No. de Serie:</td>
                    <td><?= $equipo['equipo_numero_serie'] ?></td>
                </tr>
                <tr>
                    <td class="data-label">Trabajo Realizado:</td>
                    <td colspan="12"><?= $equipo['equipo_trabajo_realizado'] ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Agregar espacio entre las dos tablas si es necesario -->
        <div style="margin-top: 20px;"></div>
        <hr>
        <!-- Segunda tabla (igual a la primera) -->
        <table class="table table-bordered table-striped mt-4">
            <tbody>
                <tr>
                    <td class="data-label" colspan="1">Fecha:</td>
                    <td colspan="2"><?= $equipo['equipo_fecha'] ?></td>
                    <td class="data-label" colspan="1">Registro:</td>
                    <td colspan="2"><?= $equipo['equipo_registro'] ?></td>
                </tr>
                <tr>
                    <th colspan="12">Oficio:</th>
                </tr>
                <tr>
                    <td class="data-label">Catálogo del Usuario:</td>
                    <td><?= $equipo['equipo_usuario_catalogo'] ?></td>
                    <td class="data-label">Nombre del Usuario:</td>
                    <td><?= $equipo['equipo_usuario_nombre'] ?></td>
                    <td class="data-label">Teléfono:</td>
                    <td><?= $equipo['equipo_telefono_usuario'] ?></td>
                </tr>
                <tr>
                    <th colspan="12">Dependencia:</th>
                </tr>
                <tr>
                    <td class="data-label" colspan="1">Catálogo del técnico entrega:</td>
                    <td colspan="2"><?= $equipo['equipo_tecnico_entrega'] ?></td>
                    <td class="data-label" colspan="1">Nombre del técnico:</td>
                    <td colspan="2"><?= $equipo['equipo_usuario_nombre'] ?></td>
                </tr>
                <tr class="center-row">
                    <th colspan="12">Características del Equipo</th>
                </tr>
                <tr>
                    <td class="data-label">Marca:</td>
                    <td><?= $equipo['equipo_marca'] ?></td>
                    <td class="data-label">Modelo:</td>
                    <td><?= $equipo['equipo_modelo'] ?></td>
                    <td class="data-label">No. de Serie:</td>
                    <td><?= $equipo['equipo_numero_serie'] ?></td>
                </tr>
                <tr>
                    <td class="data-label">Trabajo Realizado:</td>
                    <td colspan="12"><?= $equipo['equipo_trabajo_realizado'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
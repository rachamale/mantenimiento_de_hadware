<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zziy2YFZ5rPqFMPPpjBRBoxDx2PbAKL3LO9QGHvZ56z25UNR/lvO+ebBqISQSmF5" crossorigin="anonymous">
    <title>Formulario de Entrega de Equipo</title>
    <style>
        body {
            position: relative;
        }

        .container {
            position: relative;
        }



        h1 {
            text-align: center;
            font-size: 15px;
            /* Ajusta el tamaño de la fuente del título */
            /* margin: 5px 0; */
            /* Reduce el margen superior del título */
            color: black;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
            font-family: 'Arial', sans-serif;
        }

        table {
            width: 100%;
            /* margin-top: 20px; */
            /* Aumentar el margen superior de la tabla */
            margin-bottom: 20px;
            /* Aumentar el margen inferior de la tabla */
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid gray;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        /* Anula los estilos de Bootstrap para filas y celdas */
        .table-bordered tbody tr,
        .table-bordered th,
        .table-bordered td {
            border: 1px solid black !important;
        }

        th {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e0e0e0;
        }

        .data-label {
            font-weight: bold;
            font-size: 12px;
            color: #343a40;
        }

        .data-label::after {
            content: ":";
            margin-right: 3px;
        }

        .center-row th {
            text-align: center;
        }

        .hr-divider {
            border: none;
            height: 2px;
            background-color: #ddd;
            margin: 10px 0;
        }

        .form-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .form-box {
            width: 45%;
        }

        .form-label {
            display: block;
            font-size: 12px;
        }

        /* Nuevos estilos para la fila de descripción del equipo */
        .description-row {
            background-color: #ffd700;
            font-weight: bold;
            color: #343a40;
        }

        .description-row td {
            padding: 8px;
            text-align: left;
            font-size: 12px;
            border: 1px solid #dee2e6;
        }
    </style>
</head>

<body>
    <div style="position: relative; text-align: center;">
        <p style="text-align: center; color: green; line-height: 1; margin-top: 30px;">RESERVADO</p>
        <p style="text-align: center; font-size: 10pt; line-height: 1;">FECHA DE GENERACIÓN:
            <?= date('d/m/Y H:i:s') ?>
        </p>
        <div style="position: absolute; top: -50px; left: 50%; transform: translateX(-50%);">
            <img src="./images/cit.png" alt="Descripción de la imagen" style="width: 80px; height: auto;">
        </div>

    </div>



    <div class="container">
        <h1>FORMULARIO DE RECEPCIÓN DE EQUIPO PARA REPARACIÓN</h1>
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td class="data-label">FECHA:</td>
                    <td colspan="2">
                        <?= $solicitud['fecha'] ?>
                    </td>
                    <td class="data-label">REGISTRO:</td>
                    <td colspan="2">
                        <?= $solicitud['registro'] ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="6">OFICIO:
                        <?= $solicitud['oficio'] ?>
                    </th>
                </tr>
                <tr>
                    <td class="data-label">CATÁLOGO DEL USUARIO:</td>
                    <td>
                        <?= $solicitud['catalogo_usuario'] ?>
                    </td>
                    <td class="data-label">NOMBRE DEL USUARIO:</td>
                    <td>
                        <?= $solicitud['usuario'] ?>
                    </td>
                    <td class="data-label">TELÉFONO:</td>
                    <td>
                        <?= $solicitud['telefono'] ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="6">DEPENDENCIA:
                        <?= $solicitud['dependencia'] ?>
                    </th>
                </tr>
                <tr>
                    <td class="data-label">CATÁLOGO DEL TÉCNICO ENTREGA:</td>
                    <td colspan="2">
                        <?= $solicitud['catalogo_tecnico'] ?>
                    </td>
                    <td class="data-label">NOMBRES DEL TÉCNICO:</td>
                    <td colspan="2">
                        <?= $solicitud['tecnico'] ?>
                    </td>
                </tr>
                <tr class="center-row">
                    <th colspan="6">CARACTERISTICAS DEL EQUIPO</th>
                </tr>
                <tr>
                    <td class="data-label">MARCA:</td>
                    <td>
                        <?= $solicitud['marca'] ?>
                    </td>
                    <td class="data-label">MODELO:</td>
                    <td>
                        <?= $solicitud['modelo'] ?>
                    </td>
                    <td class="data-label">No. DE SERIE:</td>
                    <td>
                        <?= $solicitud['serie'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="data-label">TIPO DE EQUIPO:</td>
                    <td colspan="6">
                        <?= $solicitud['tipo_equipo'] ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td class="data-label">FIRMA:</td>
                    <td colspan="2" style='color: white;'>
                        ______________________________________
                    </td>
                    <td class="data-label">FIRMA:</td>
                    <td colspan="2" style='color: white;'>
                        ______________________________________
                    </td>
                </tr>
                <tr>
                    <td class="data-label">ENTREGA:</td>
                    <td colspan="2">
                        <?= $solicitud['usuario'] ?>
                    </td>
                    <td class="data-label">RECIBE:</td>
                    <td colspan="2">
                        <?= $solicitud['tecnico'] ?>
                    </td>
                </tr>

            </tbody>
        </table>

        <!-- Agregar espacio entre las dos tablas si es necesario -->
        <br><br>
        <hr class="hr-divider">
        <br><br><br>

        <h1>FORMULARIO DE RECEPCIÓN DE EQUIPO PARA REPARACIÓN</h1>

        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td class="data-label">FECHA:</td>
                    <td colspan="2">
                        <?= $solicitud['fecha'] ?>
                    </td>
                    <td class="data-label">REGISTRO:</td>
                    <td colspan="2">
                        <?= $solicitud['registro'] ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="6">Oficio:
                        <?= $solicitud['oficio'] ?>
                    </th>
                </tr>
                <tr>
                    <td class="data-label">CATÁLOGO DEL USUARIO:</td>
                    <td>
                        <?= $solicitud['catalogo_usuario'] ?>
                    </td>
                    <td class="data-label">NOMBRE DEL USUARIO:</td>
                    <td>
                        <?= $solicitud['usuario'] ?>
                    </td>
                    <td class="data-label">TELÉFONO:</td>
                    <td>
                        <?= $solicitud['telefono'] ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="6">DEPENDENCIA:
                        <?= $solicitud['dependencia'] ?>
                    </th>
                </tr>
                <tr>
                    <td class="data-label">CATÁLOGO DEL TÉCNICO ENTREGA:</td>
                    <td colspan="2">
                        <?= $solicitud['catalogo_tecnico'] ?>
                    </td>
                    <td class="data-label">NOMBRE DEL TÉCNICO:</td>
                    <td colspan="2">
                        <?= $solicitud['tecnico'] ?>
                    </td>
                </tr>
                <tr class="center-row">
                    <th colspan="6">CARACTERISTICAS DEL EQUIP </th>
                </tr>
                <tr>
                    <td class="data-label">MARCA:</td>
                    <td>
                        <?= $solicitud['marca'] ?>
                    </td>
                    <td class="data-label">MODELO:</td>
                    <td>
                        <?= $solicitud['modelo'] ?>
                    </td>
                    <td class="data-label">NO. DE SERIE:</td>
                    <td>
                        <?= $solicitud['serie'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="data-label">TIPO DE EQUIPO:</td>
                    <td colspan="6">
                        <?= $solicitud['tipo_equipo'] ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td class="data-label">FIRMA:</td>
                    <td colspan="2" style='color: white;'>
                        ______________________________________
                    </td>
                    <td class="data-label">FIRMA:</td>
                    <td colspan="2" style='color: white;'>
                        ______________________________________
                    </td>
                </tr>
                <tr>
                    <td class="data-label">ENTREGA:</td>
                    <td colspan="2">
                        <?= $solicitud['usuario'] ?>
                    </td>
                    <td class="data-label">RECIBE:</td>
                    <td colspan="2">
                        <?= $solicitud['tecnico'] ?>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</body>

</html>
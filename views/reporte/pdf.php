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
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto 20px;
            /* Aumentar el margen inferior y reducir el margen superior */
        }

        h1 {
            text-align: center;
            font-size: 25px;
            /* Aumenta el tamaño de la fuente para un impacto visual */
            margin: 40px 0;
            /* Incrementa el margen para más espacio alrededor del título */
            color: black;
            /* Cambia el color del texto a un tono azul */
            text-transform: uppercase;
            /* Convierte el texto a mayúsculas */
            letter-spacing: 1px;
            /* Agrega un espaciado entre las letras */
            font-weight: bold;
            /* Acentúa la negrita para un mayor énfasis */
            font-family: 'Arial', sans-serif;
            /* Especifica la fuente, también puedes probar otras fuentes */
        }

        table {
            width: 100%;
            margin-top: 20px;
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
    <div class="container">
        <h1>FORMULARIO DE ENTREGA DE EQUIPO</h1>
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td class="data-label">FECHA:</td>
                    <td colspan="2">
                        <?= $equipo['fecha'] ?>
                    </td>
                    <td class="data-label">REGISTRO:</td>
                    <td colspan="2">
                        <?= $equipo['registro'] ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="6">OFICIO:
                        <?= $equipo['oficio'] ?>
                    </th>
                </tr>
                <tr>
                    <td class="data-label">CATÁLOGO DEL USUARIO:</td>
                    <td>
                        <?= $equipo['catalogo_usuario'] ?>
                    </td>
                    <td class="data-label">NOMBRE DEL USUARIO:</td>
                    <td>
                        <?= $equipo['usuario'] ?>
                    </td>
                    <td class="data-label">TELÉFONO:</td>
                    <td>
                        <?= $equipo['telefono'] ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="6">DEPENDENCIA:
                        <?= $equipo['dependencia'] ?>
                    </th>
                </tr>
                <tr>
                    <td class="data-label">CATÁLOGO DEL TÉCNICO ENTREGA:</td>
                    <td colspan="2">
                        <?= $equipo['catalogo_tecnico'] ?>
                    </td>
                    <td class="data-label">NOMBRES DEL TÉCNICO:</td>
                    <td colspan="2">
                        <?= $equipo['tecnico'] ?>
                    </td>
                </tr>
                <tr class="center-row">
                    <th colspan="6">CARACTERISTICAS DEL EQUIPO</th>
                </tr>
                <tr>
                    <td class="data-label">MARCA:</td>
                    <td>
                        <?= $equipo['marca'] ?>
                    </td>
                    <td class="data-label">MODELO:</td>
                    <td>
                        <?= $equipo['modelo'] ?>
                    </td>
                    <td class="data-label">No. DE SERIE:</td>
                    <td>
                        <?= $equipo['serie'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="data-label">TRABAJO REALIZADO:</td>
                    <td colspan="6">
                        <?= $equipo['trabajo'] ?>
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
                        <?= $equipo['usuario'] ?>
                    </td>
                    <td class="data-label">RECIBE:</td>
                    <td colspan="2">
                        <?= $equipo['tecnico'] ?>
                    </td>
                </tr>

            </tbody>
        </table>

        <!-- Agregar espacio entre las dos tablas si es necesario -->
        <hr class="hr-divider">
        <br>
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td class="data-label">FECHA:</td>
                    <td colspan="2">
                        <?= $equipo['fecha'] ?>
                    </td>
                    <td class="data-label">REGISTRO:</td>
                    <td colspan="2">
                        <?= $equipo['registro'] ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="6">Oficio:
                        <?= $equipo['oficio'] ?>
                    </th>
                </tr>
                <tr>
                    <td class="data-label">CATÁLOGO DEL USUARIO:</td>
                    <td>
                        <?= $equipo['catalogo_usuario'] ?>
                    </td>
                    <td class="data-label">NOMBRE DEL USUARIO:</td>
                    <td>
                        <?= $equipo['usuario'] ?>
                    </td>
                    <td class="data-label">TELÉFONO:</td>
                    <td>
                        <?= $equipo['telefono'] ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="6">DEPENDENCIA:
                        <?= $equipo['dependencia'] ?>
                    </th>
                </tr>
                <tr>
                    <td class="data-label">CATÁLOGO DEL TÉCNICO ENTREGA:</td>
                    <td colspan="2">
                        <?= $equipo['catalogo_tecnico'] ?>
                    </td>
                    <td class="data-label">NOMBRE DEL TÉCNICO:</td>
                    <td colspan="2">
                        <?= $equipo['tecnico'] ?>
                    </td>
                </tr>
                <tr class="center-row">
                    <th colspan="6">CARACTERISTICAS DEL EQUIPO</th>
                </tr>
                <tr>
                    <td class="data-label">MARCA:</td>
                    <td>
                        <?= $equipo['marca'] ?>
                    </td>
                    <td class="data-label">MODELO:</td>
                    <td>
                        <?= $equipo['modelo'] ?>
                    </td>
                    <td class="data-label">NO. DE SERIE:</td>
                    <td>
                        <?= $equipo['serie'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="data-label">TRABAJO REALIZADO:</td>
                    <td colspan="6">
                        <?= $equipo['trabajo'] ?>
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
                        <?= $equipo['usuario'] ?>
                    </td>
                    <td class="data-label">RECIBE:</td>
                    <td colspan="2">
                        <?= $equipo['tecnico'] ?>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</body>

</html>
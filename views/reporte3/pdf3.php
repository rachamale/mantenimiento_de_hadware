<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Equipos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            text-align: center;
        }

        header span {
            font-size: 22px;
            font-weight: bold;
            color: #000;
        }

        .report-header {
            text-align: center;
            margin: 20px 0;
        }

        .report-title {
            font-size: 24px;
            color: #000;
            margin: 20px 0;
            text-align: center;
        }

        .styled-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9em;
            margin-bottom: 30px;
            background-color: #fff;
            border: 2px solid #000;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
            border: 1px solid #000;
            text-align: left;
        }

        .styled-table thead th {
            background-color: #f2f2f2;
            color: #000;
        }

        .styled-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .fecha {
            font-size: 0.9em;
            color: #333;
            margin-bottom: 20px;
        }

        header {
            border-bottom: 2px solid #000;
            bottom: 25px;
        }

        .report-footer {
            border-top: 2px solid #000;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <div style="text-align: center;">
            <div style="position: absolute; top: -50px; left: 50%; transform: translateX(-50%);">
                <img src="./images/cit.png" alt="Descripción de la imagen" style="width: 80px; height: auto;">
            </div>
        </div>
    </header>

    <div class="report">
        <h1 class="report-title text-align: center; ">Reporte de Equipos</h1>
        <span>Soporte Tecnico</span>
        <div class="fecha">
            <span class="right">Fecha del Reporte: <?= date("d/m/Y") ?></span>
        </div>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>NO.</th>
                <th>FECHA</th>
                <th>OFICIO</th>
                <th>DESCRIPCION</th>
                <th>TIPO DE EQUIPO</th>
                <th>DEPENDENCIA</th>
                <th>CAT USU ENTREGO</th>
                <th>CAT TEC RECIBE</th>
                <th>CAT TECNICO REPARO</th>
                <th>CAT USU RECIBE</th>
                <th>CAT TEC ENTREGA</th>
            </tr>
        </thead>
        <tbody>
    <?php $contador = 1; ?>
    <?php foreach($solicitud as $equipo) : ?>
        <tr>
            <td><?= $contador++ ?></td>
            <td><?= ($equipo['equi_his_fecha']) ?></td>
            <td><?= ($equipo['equipo_oficio']) ?></td>
            <td><?= ($equipo['equipo_estado_descripcion']) ?></td>
            <td><?= ($equipo['tipo_equipo_descripcion']) ?></td>
            <td><?= ($equipo['dep_desc_lg']) ?></td>
            <td><?= ($equipo['sol_usuario_catalogo']) ?></td>
            <td><?= ($equipo['sol_tecnico_catalogo']) ?></td>
            <td><?= ($equipo['rep_tecnico_catalogo']) ?></td>
            <td><?= ($equipo['ent_usuario_catalogo']) ?></td>
            <td><?= ($equipo['ent_tecnico_catalogo']) ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>
    </table>

</body>

</html>

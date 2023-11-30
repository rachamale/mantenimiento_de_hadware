<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de Mantenimiento de Software</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .reporte-titulo {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            transition: color 0.3s ease;
        }

        .reporte-titulo:hover {
            color: #2079b0;
        }

        #btnActualizar {
            background-color: #3498db;
            color: #fff;
            padding: 15px 25px;
            border: none;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: block;
            margin: auto;
            margin-top: 20px;
        }

        #btnActualizar:hover {
            background-color: #2079b0;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 30px;
        }

        .card {
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            margin-bottom: 30px;
            flex: 0 0 calc(30% - 20px);
            border-radius: 10px;
            box-sizing: border-box;
        }

        @media screen and (max-width: 768px) {
            .card {
                flex-basis: calc(50% - 20px);
            }
        }

        .card:hover {
            box-shadow: 0 10px 20px rgba(33, 150, 243, 0.5);
            transform: translateY(-10px);
        }

        .card h4 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="reporte-titulo">ESTADISTICAS DE MANTENIMIENTO DE SOFTWARE</h1>
        <button id="btnActualizar">Actualizar</button>
        <div class="row">
            <div class="card">
                <h4>Equipos</h4>
                <canvas id="chartEquipo"></canvas>
            </div>
            <div class="card">
                <h4>Dependencia</h4>
                <canvas id="chartEquiposDependencia"></canvas>
            </div>
            <div class="card">
                <h4>Solicitudes</h4>
                <canvas id="chartSolicitudes"></canvas>
            </div>
            <div class="card">
                <h4>Reparaciones</h4>
                <canvas id="chartReparaciones"></canvas>
            </div>
            <div class="card">
                <h4>Entregas</h4>
                <canvas id="chartEntregas"></canvas>
            </div>
            <div class="card">
                <h4>Marcas de Equipos</h4>
                <canvas id="chartMarcasEquipos"></canvas>
            </div>
            <div class="card">
                <h4>Entregas Generales</h4>
                <canvas id="chartEntregasGeneral"></canvas>
            </div>
        </div>
    </div>

    <script src="<?= asset('./build/js/estadisticas/index.js') ?>"></script>
</body>

</html>
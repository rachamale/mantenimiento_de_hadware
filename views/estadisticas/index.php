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
            flex: 0 0 calc(35% - 20px);
            /* Ajusta el valor aquí para cambiar el ancho */
            border-radius: 10px;
            box-sizing: border-box;
        }

        @media screen and (max-width: 1000px) {
            .card {
                flex-basis: calc(100% - 50px);
                /* Ajusta el valor aquí para cambiar el ancho en pantallas más pequeñas */
            }
        }

        .card:hover {
            box-shadow: 0 30px 50px rgba(33, 150, 243, 0.5);
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

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-6"> <!-- Reduje el ancho del contenedor a col-lg-6 -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-3">Estadísticas</h5>
                    <form id="formularioFiltros" class="text-center"> <!-- Centré el formulario en el contenedor -->
                        <div class="mb-3 d-inline-flex align-items-center">
                            <!-- Utilicé d-inline-flex y align-items-center para centrar los elementos horizontalmente -->
                            <div class="me-3">
                                <label for="fechaInicio" class="form-label">Inicio</label>
                                <input type="date" class="form-control" id="fechaInicio" name="fechaInicio">
                            </div>
                            <div>
                                <label for="fechaFin" class="form-label">Fin</label>
                                <input type="date" class="form-control" id="fechaFin" name="fechaFin">
                            </div>
                        </div>
                        <button id="btnActualizar" class="btn btn-info mt-2" style="width: 50%;"
                            type="button">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<body>
    <div class="container">
        <h1 class="reporte-titulo">ESTADISTICAS DE MANTENIMIENTO DE SOFTWARE</h1>
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
            <div class="card">
                <h4>Datos Equipos por estado</h4>
                <canvas id="chartBuscarDatosEquiposPorEstado"></canvas>
            </div>
            <div class="card">
                <h4>Tipo Equipos Por Dependencia</h4>
                <canvas id="chartBuscarDatosEquiposPorTipo"></canvas>
            </div>
        </div>
    </div>

    <script src="<?= asset('./build/js/estadisticas/index.js') ?>"></script>
</body>

</html>
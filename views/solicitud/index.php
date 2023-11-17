<div>


    <style>
        /* Estilos para la parte de ingreso de monitores */
        img {
            border: 2px solid #ccc;
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }

        /* Estilos para el contenedor principal */
        .container-main {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            width: 90%;
            /* Contenedor ocupa el 90% de la pantalla */
            margin: 60px auto 0;
            /* Espacio para el menú sin superponerse */
        }

        .row.buttons {
            display: flex;
            justify-content: center;
        }

        .card.device {
            cursor: pointer;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 5px 75px;
            /* Aumenta el padding para hacer los botones más largos */
            margin: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .card.device:hover {
            background-color: #007BFF;
            color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform: scale(1.05);
        }

        .card.monitor {
            background-color: #3498db;
        }

        .card.impresora {
            background-color: #27ae60;
        }

        .card.cpu {
            background-color: #e74c3c;
        }

        .card.otros {
            background-color: #f39c12;
        }

        .selected-device {
            text-align: center;
            margin-top: 20px;
        }

        .selected-device p {
            font-size: 20px;
            font-weight: bold;
            color: #007BFF;
        }

        .border {
            border: 15px solid #dcdcdc;
            border-radius: 5px;
            box-shadow: 0 50px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            background-color: #fff;
        }

        h1 {
            background-color: #343a40;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        /* Estilo del contenedor de la tabla */
        .table-container {
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 100px 30px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            background-color: #fff;
        }

        /* Estilo del título */
        .table-container h1 {
            background-color: #343a40;
            color: #ffffff;
            padding: 10px;
            text-align: center;
        }

        /* Estilo de la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            padding: 10px;
            border: 1px solid #ccc;
            vertical-align: top;
            width: 50%;
        }

        table td strong {
            display: block;
            font-weight: bold;
        }

        .btn-device {
            margin-bottom: 30px;
        }

        .btn-device {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100px;
            /* Establece una altura fija para los botones */
            border: 10px solid #ccc;
            box-shadow: 0 30px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin: 15px;
            transition: background-color 0.3s;
        }

        .btn-device:hover {
            background-color: #f0f0f0;
        }

        #equipoForm2 .container-main {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        #equipoForm2 .btn-device {
            width: 100%;
            margin: 5px;
        }

        #equipoForm2 .container-main {
            display: flex;
            justify-content: center;
            /* Alinea los div horizontalmente en el centro */
            flex-wrap: wrap;
            /* Permite que los div se ajusten a la pantalla si el espacio es limitado */
        }

        #equipoForm2 .btn-device {
            flex: 0 1 calc(25% - 10px);
            /* Distribuye en 4 columnas y ajusta el espacio entre ellos */
            margin: 5px;
            /* Espacio entre los botones */
        }

        #subir {
            border: 3px solid #8BA3C9;
            border-radius: 8px;
            width: 80px;
            /* Aumentado el ancho */
            height: 60px;
            /* Aumentado el alto */
            background-color: #336699;
            color: #ffffff;
            font-size: 16px;
            /* Aumentado el tamaño de la fuente */
            margin: 10px;
            /* Ajuste de margen */
            cursor: pointer;
            outline: none;
            position: absolute;
            bottom: 20px;
            /* Ajustado la distancia desde la parte inferior */
            right: 10px;
            /* Ajustado la distancia desde la derecha */
        }

        #subir:hover {
            background-color: #001F3F;
        }
    </style>


    <script>
        // Función para prevenir el envío del formulario al presionar "Enter"
        function disableEnterSubmit(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
            }
        }

    </script>


    <form id="formularioEquipo" onkeypress="disableEnterSubmit(event)">
        <div id="equipoForm1">
            <h1 class="text-center">FORMULARIO DE INGRESO DE DATOS</h1>
            <div class="row justify-content-center mb-5">
                <div class="container p-4 shadow-lg">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="./images/rac2.jpeg" id="foto" alt="Fotografía">
                        </div>
                        <div class="col-md-9">
                            <!-- Primera sección de campos -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="sol_fecha">
                                        <i class="fas fa-calendar"></i> <strong>Fecha de Ingreso</strong>
                                    </label>
                                    <input type="date" name="sol_fecha" id="sol_fecha" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="equipo_oficio">
                                        <i class="fas fa-file-alt"></i> <strong>Número de Oficio</strong>
                                    </label>
                                    <input type="text" name="equipo_oficio" id="equipo_oficio" class="form-control">
                                </div>
                            </div>

                            <!-- Segunda sección de campos -->
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="sol_usuario_catalogo">
                                        <i class="fas fa-cogs"></i> <strong>Catálogo del Usuario</strong>
                                    </label>
                                    <input value="" id="sol_usuario_catalogo" name="sol_usuario_catalogo"
                                        class="form-control" type="number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="equipo_usuario_nombre">
                                        <i class="fas fa-user"></i> <strong>Nombres del Usuario</strong>
                                    </label>
                                    <input type="text" name="equipo_usuario_nombre" id="equipo_usuario_nombre"
                                        class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="sol_usuario_telefono">
                                        <i class="fas fa-phone"></i> <strong>Número de teléfono</strong>
                                    </label>
                                    <input type="number" name="sol_usuario_telefono" id="sol_usuario_telefono"
                                        class="form-control">
                                </div>
                            </div>

                            <!-- Tercera sección de campos -->
                            <div class="form-group">
                                <input type="hidden" name="equipo_dependencia" id="equipo_dependencia"
                                    class="form-control">
                                <label for="equipo_nombre_dependencia" class="text-center">
                                    <i class="fas fa-building"></i> <strong>Dependencia del Equipo</strong>
                                </label>
                                <input type="text" name="equipo_nombre_dependencia" id="equipo_nombre_dependencia"
                                    class="form-control" readonly>
                            </div>
                        </div>
                    </div>

                    <br><br>
                    <!-- Cuarta sección de campos -->
                    <div class="row">
                        <div class="col-md-3">
                            <img src="./images/rac2.jpeg" id="foto2" alt="Fotografía">
                        </div>
                        <div class="col-md-9">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="sol_tecnico_catalogo">
                                        <i class="fas fa-cogs"></i> <strong>Catálogo del Técnico</strong>
                                    </label>
                                    <input type="number" name="sol_tecnico_catalogo" id="sol_tecnico_catalogo"
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="equipo_tecnico_nombre">
                                        <i class="fas fa-user"></i> <strong>Nombres y Apellidos del Técnico</strong>
                                    </label>
                                    <input type="text" name="equipo_tecnico_nombre" id="equipo_tecnico_nombre"
                                        class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- PARTE 2 -->

        <div id="equipoForm2">
            <h1 class="text-center">SELECCIONA UN DISPOSITIVO</h1>
            <div class="row justify-content-center mb-5">
                <div class="col-lg-11 border bg-light p-5">
                    <!-- Contenedor principal -->
                    <div class="container p-4 shadow-lg">
                        <!-- Parte de selección de dispositivo -->
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-primary btn-device card device monitor" id="btn-monitor">
                                    <i class="fas fa-desktop fa-3x"></i>
                                    <p>Monitor</p>
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-success btn-device card device impresora" id="btn-impresora">
                                    <i class="fas fa-print fa-3x"></i>
                                    <p>Impresora</p>
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-danger btn-device card device cpu" id="btn-cpu">
                                    <i class="fas fa-cog fa-3x"></i>
                                    <p>CPU</p>
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-warning btn-device card device otros" id="btn-otros">
                                    <i class="fas fa-question-circle fa-3x"></i>
                                    <p>Otros</p>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- PARTE 3 -->

        <div id="equipoForm3">
            <h1 class="text-center" id="tituloFormEquipo">FORMULARIO DE INGRESO </h1>
            <div class="row justify-content-center mb-5">
                <div class="container p-4 shadow-lg">
                    <div class="row mb-3">

                        <div class="col">
                            <label for="equipo_motivo">
                                <i class="fas fa-comment"></i> <strong>Motivo de Ingreso</strong>
                            </label>
                            <input type="text" name="equipo_motivo" id="equipo_motivo" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="equipo_modelo">
                                <i class="fas fa-desktop"></i> <strong>Modelo del Equipo</strong>
                            </label>
                            <input type="text" name="equipo_modelo" id="equipo_modelo" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="equipo_serial">
                                <i class="fas fa-barcode"></i> <strong>Serie del Equipo</strong>
                            </label>
                            <input type="text" name="equipo_serial" id="equipo_serial" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3" id="camposCPU1">
                        <div class="col-md-4">
                            <label for="equipo_almacenamiento">
                                <i class="fas fa-hdd"></i> <strong>Almacenamiento del Equipo</strong>
                            </label>
                            <input type="text" name="equipo_almacenamiento" id="equipo_almacenamiento"
                                class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="equipo_lector_cd">
                                <i class="fas fa-compact-disc"></i> <strong>Lector CD</strong>
                            </label>
                            <select name="equipo_lector_cd" id="equipo_lector_cd" class="form-control">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="equipo_tarjeta_sonido">
                                <i class="fas fa-volume-up"></i> <strong>Tarjeta de Sonido</strong>
                            </label>
                            <select name="equipo_tarjeta_sonido" id="equipo_tarjeta_sonido" class="form-control">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3" id="camposCPU2">
                        <div class="col-md-4">
                            <label for="equipo_drivers">
                                <i class="fas fa-puzzle-piece"></i> <strong>Drivers del Equipo</strong>
                            </label>
                            <select name="equipo_drivers" id="equipo_drivers" class="form-control">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="equipo_tarjeta_grafica">
                                <i class="fas fa-video"></i> <strong>Tarjeta Gráfica</strong>
                            </label>
                            <select name="equipo_tarjeta_grafica" id="equipo_tarjeta_grafica" class="form-control">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="equipo_fuente_poder">
                                <i class="fas fa-plug"></i> <strong>Fuente de Poder</strong>
                            </label>
                            <select name="equipo_fuente_poder" id="equipo_fuente_poder" class="form-control">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3" id="camposOtros">
                        <div class="col-md-12">
                            <label for="equipo_tipo">
                                <i class="fas fa-puzzle-piece"></i> <strong>Tipo de Equipos</strong>
                            </label>
                            <select name="equipo_tipo" id="equipo_tipo" class="form-control">
                                <option value="">Selecione puesto...</option>
                                <?php foreach ($tipos as $tipo): ?>
                                    <option value="<?= $tipo['tipo_equipo_codigo'] ?>">
                                        <?= $tipo['tipo_equipo_descripcion'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="equipo_con_cable">
                                <i class="fas fa-charging-station"></i> <strong>Equipo con Cable</strong>
                            </label>
                            <select name="equipo_con_cable" id="equipo_con_cable" class="form-control">
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="equipo_marca">
                                <i class="fas fa-building"></i> <strong>Marca del Equipo</strong>
                            </label>
                            <select name="equipo_marca" id="equipo_marca" class="form-control">
                                <option value="">Selecione puesto...</option>
                                <?php foreach ($marcas as $marca): ?>
                                    <option value="<?= $marca['marca_equipo_codigo'] ?>">
                                        <?= $marca['marca_equipo_descripcion'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="form-group col-md-9">
                            <label for="equipo_descripcion">
                                <i class="fas fa-comment"></i> <strong>Descripción del Equipo</strong>
                            </label>
                            <input type="text" name="equipo_descripcion" id="equipo_descripcion" class="form-control">
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="mr-2">
                            <button type="button" id='subir' class="form-control">
                                <i class="fas fa-arrow-circle-up"></i> Listo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PARTE 4 -->
        <div id="equipoForm4" class="form-container">
            <div class="container p-4 shadow-lg">
                <h1 class="form-title">Chequeo de Datos</h1>

                <form id="formularioDatos" class="datos-form">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="equipo_fecha_entrega" class="titulo-nombre">Fecha de Ingreso:</label>
                            <input type='date' id='equipo_fecha_entrega' class="form-control resaltar-rojo" readonly value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="equipo_oficio1" class="titulo-nombre">Número de Oficio:</label>
                            <input type='text' id='equipo_oficio1' class="form-control resaltar-rojo" readonly value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="equipo_usuario_cat_entrega">Catálogo del Usuario:</label>
                            <input type='number' id='equipo_usuario_cat_entrega' class="form-control resaltar-rojo" readonly 
                                value="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="equipo_usuario_nombre1" class="titulo-nombre">Nombres y Apellidos del
                                Usuario:</label>
                            <input type='text' id='equipo_usuario_nombre1' class="form-control resaltar-rojo" readonly value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="equipo_usuario_numero">Número de teléfono del Usuario:</label>
                            <input type='number' id='equipo_usuario_numero' class="form-control resaltar-rojo" readonly value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="equipo_dependencia1">Dependencia del Equipo:</label>
                            <input type='text' id='equipo_dependencia1' class="form-control resaltar-rojo" readonly value="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="equipo_tecnico_catalogo">Catálogo del Técnico:</label>
                            <input type='number' id='equipo_tecnico_catalogo' class="form-control resaltar-rojo" readonly 
                                value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="equipo_tecnico_nombre1" class="titulo-nombre">Nombres y Apellidos del
                                Técnico:</label>
                            <input type='text' id='equipo_tecnico_nombre1' class="form-control resaltar-rojo" readonly value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="equipo_modelo1" class="titulo-nombre">Modelo del Equipo:</label>
                            <input type='text' id='equipo_modelo1' class="form-control resaltar-rojo" readonly value="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="equipo_serial1" class="titulo-nombre">Serie del Equipo:</label>
                            <input type='text' id='equipo_serial1' class="form-control resaltar-rojo" readonly value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="equipo_motivo1">Motivo de Ingreso:</label>
                            <input type='text' id='equipo_motivo1' class="form-control resaltar-rojo" readonly value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="equipo_descripcion1" class="titulo-nombre">Descripción del Equipo:</label>
                            <input type='text' id='equipo_descripcion1' class="form-control resaltar-rojo" readonly value="">
                        </div>
                    </div>

                    <div class="form-row detalleCPU">
                        <div class="form-group col-md-6">
                            <label for="equipo_almacenamiento1" class="titulo-nombre">Almacenamiento del Equipo:</label>
                            <input type='text' id='equipo_almacenamiento1' class="form-control resaltar-rojo" readonly value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="equipo_marca1" class="titulo-nombre">Marca del Equipo:</label>
                            <input type='number' id='equipo_marca1' class="form-control resaltar-rojo" readonly value="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="equipo_lector_cd1" class="titulo-nombre">Lector de CD:</label>
                            <input type='text' id='equipo_lector_cd1' class="form-control resaltar-rojo" readonly value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="equipo_tarjeta_sonido1" class="titulo-nombre">Tarjeta de Sonido:</label>
                            <input type='text' id='equipo_tarjeta_sonido1' class="form-control resaltar-rojo" readonly value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="equipo_drivers1" class="titulo-nombre">Drivers:</label>
                            <input type='text' id='equipo_drivers1' class="form-control resaltar-rojo" readonly value="">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="equipo_tarjeta_grafica1" class="titulo-nombre">Tarjeta Gráfica:</label>
                            <input type='text' id='equipo_tarjeta_grafica1' class="form-control resaltar-rojo" readonly value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="equipo_fuente_poder1" class="titulo-nombre">Fuente de Poder:</label>
                            <input type='text' id='equipo_fuente_poder1' class="form-control resaltar-rojo" readonly value="">
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="btn-group w-100">
                        <button type="button" id="btnAnterior" class="btn btn-info">
                            <i class="fas fa-chevron-left"></i> Anterior
                        </button>
                        <button type="button" id="btnSiguiente" class="btn btn-success">
                            Siguiente <i class="fas fa-chevron-right"></i>
                        </button>
                        <button type="button" id="btnGuardar" class="btn btn-success">
                            Guardar <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?= asset('./build/js/solicitud/index.js') ?>"></script>



</div>
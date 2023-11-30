<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="build/js/app.js"></script>
    <link rel="shortcut icon" href="<?= asset('images/cit.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= asset('build/styles.css') ?>">
    <title>mantenimiento_de_hardware</title>

    <style>
        /* Efecto hover 3D impresionante */
        .my-custom-navbar .nav-link,
        .my-custom-navbar .btn {
            position: relative;
            overflow: hidden;
            transform: perspective(1000px) rotateX(0) rotateY(0) scale(1);
            transform-origin: center;
            transition: transform 0.5s;
        }

        .my-custom-navbar .nav-link:before,
        .my-custom-navbar .btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, #2A00FF, #080419, #2911A0);
            mix-blend-mode: screen;
            z-index: 1;
            transform: scaleX(0);
            transform-origin: 0 50%;
            transition: transform 0.5s;
        }

        .my-custom-navbar .nav-link:hover,
        .my-custom-navbar .btn:hover {
            transform: perspective(1000px) rotateX(-5deg) rotateY(5deg) scale(1.1);
        }

        .my-custom-navbar .nav-link:hover:before,
        .my-custom-navbar .btn:hover:before {
            transform: scaleX(1);
        }

        /* Estilos adicionales */
        .my-custom-navbar .nav-link:hover {
            color: #ffffff;
            /* Color al pasar el mouse sobre el enlace */
            filter: saturate(120%);
            /* Aumenta la saturación al pasar el mouse */
        }

        .my-custom-navbar .btn:hover {
            background-color: #2C18E6;
            /* Color al pasar el mouse sobre el botón */
            border-color: #0661A7;
            /* Color del borde al pasar el mouse sobre el botón */
        }

        /* Estilos para la barra de progreso */
        .my-custom-navbar .progress-bar-animated:hover {
            animation-play-state: paused;
        }

        /* Estilos del navbar */
        .my-custom-navbar .navbar {
            background-color: #0661A7;
            /* Color de fondo del navbar */
            box-shadow: none;
            /* Quitamos el sombreado */
        }

        /* Ajustamos el margen entre elementos del navbar */
        .my-custom-navbar .navbar-nav {
            margin: 0;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark my-custom-navbar">

        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
                aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/mantenimiento_de_hardware/"> <img src="<?= asset('./images/cit.png') ?>"
                    width="35px'" alt="cit">SOPORTE TÉCNICO</a>
            <div class="collapse navbar-collapse" id="navbarToggler">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin: 0;">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/mantenimiento_de_hardware/"><i
                                class="bi bi-house-fill me-2"></i>Inicio</a>
                    </li>
                    <ul class="navbar-nav">
                        <div class="nav-item dropdown">
                            <a class="dropdown-item nav-link bg-dark text-white" href="#" data-bs-toggle="dropdown">
                                <img src="./images/mantenimiento.png" alt="Ícono Formulario" class="menu-icon"
                                    style="width: 1cm; height: 1cm;">
                                <span style="font-size: 0.9em;">MANTENIMIENTOS</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" id="dropwdownRevision" style="margin: 0;">
                                <li>
                                    <a class="dropdown-item nav-link bg-primary text-white"
                                        href="/mantenimiento_de_hardware/marca">
                                        <img src="./images/marca.png" alt="Ícono Formulario" class="menu-icon"
                                            style="width: 1cm; height: 1cm;">
                                        <span style="font-size: 0.9em;">MARCA</span>
                                    </a>

                                    <a class="dropdown-item nav-link bg-primary text-white"
                                        href="/mantenimiento_de_hardware/equipo_estado">
                                        <img src="./images/estado.png" alt="Ícono Formulario" class="menu-icon"
                                            style="width: 1cm; height: 1cm;">
                                        <span style="font-size: 0.9em;">ESTADO DEL EQUIPO</span>
                                    </a>

                                    <a class="dropdown-item nav-link bg-primary text-white"
                                        href="/mantenimiento_de_hardware/tipo_equipo">
                                        <img src="./images/dispositivos.png" alt="Ícono Formulario" class="menu-icon"
                                            style="width: 1cm; height: 1cm;">
                                        <span style="font-size: 0.9em;">TIPO DE EQUIPOS</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="nav-item d-flex">
                            <a class="dropdown-item nav-link bg-dark text-white"
                                href="/mantenimiento_de_hardware/solicitud">
                                <img src="./images/registro.png" alt="Ícono Formulario" class="menu-icon"
                                    style="width: 1cm; height: 1cm;">
                                <span style="font-size: 0.9em;">INGRESO DATOS</span>
                            </a>
                        </div>

                        <div class="nav-item d-flex">
                            <a class="dropdown-item nav-link bg-dark text-white"
                                href="/mantenimiento_de_hardware/mantenimientos">
                                <img src="./images/reparacion.png" alt="Ícono Formulario" class="menu-icon"
                                    style="width: 1cm; height: 1cm;">
                                <span style="font-size: 0.9em;">EQUIPO MANTENIMIENTO</span>
                            </a>
                        </div>

                        <div class="nav-item d-flex">
                            <a class="dropdown-item nav-link bg-dark text-white"
                                href="/mantenimiento_de_hardware/mantenimientos2">
                                <img src="./images/entregar.png" alt="Ícono Formulario" class="menu-icon"
                                    style="width: 1cm; height: 1cm;">
                                <span style="font-size: 0.9em;">EQUIPO A ENTREGAR</span>
                            </a>
                        </div>

                        <div class="nav-item d-flex">
                            <a class="dropdown-item nav-link bg-dark text-white"
                                href="/mantenimiento_de_hardware/mantenimientos3">
                                <img src="./images/entrega.png" alt="Ícono Formulario" class="menu-icon"
                                    style="width: 1cm; height: 1cm;">
                                <span style="font-size: 0.9em;">EQUIPOS ENTREGADOS</span>
                            </a>
                        </div>

                        <div class="nav-item d-flex">
                            <a class="dropdown-item nav-link bg-dark text-white"
                                href="/mantenimiento_de_hardware/historial">
                                <img src="./images/historial.png" alt="Ícono Formulario" class="menu-icon"
                                    style="width: 1cm; height: 1cm;">
                                <span style="font-size: 0.9em;">HISTORIAL</span>
                            </a>
                        </div>

                        <div class="nav-item d-flex">
                            <a class="dropdown-item nav-link bg-dark text-white"
                                href="/mantenimiento_de_hardware/estadisticas">
                                <img src="./images/estadistica.png" alt="Ícono Formulario" class="menu-icon"
                                    style="width: 1cm; height: 1cm;">
                                <span style="font-size: 0.9em;">ESTADISTICAS</span>
                            </a>
                        </div>
                    </ul>

                    <div class="col-lg-1 d-flex mb-lg-0 mb-2 ms-auto">
                        <a href="/menu/" class="btn btn-danger">
                            <i class="bi bi-arrow-bar-left"></i>MENÚ
                        </a>
                    </div>


            </div>
        </div>
    </nav>
    <div class="progress fixed-bottom" style="height: 6px;">
        <div class="progress-bar progress-bar-animated bg-danger" id="bar" role="progressbar" aria-valuemin="0"
            aria-valuemax="100"></div>
    </div>
    <div class="container-fluid pt-5 mb-4" style="min-height: 85vh">
        <?php echo $contenido; ?>
    </div>
    <div class="container-fluid ">
        <div class="row justify-content-center text-center">
            <div class="col-12">
                <p style="font-size:xx-small; font-weight: bold;">
                    Comando de Informática y Tecnología,
                    <?= date('Y') ?> &copy;
                </p>
            </div>
        </div>
    </div>
</body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</html>
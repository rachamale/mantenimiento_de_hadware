<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="build/js/app.js"></script>
    <link rel="shortcut icon" href="<?= asset('images/cit.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= asset('build/styles.css') ?>">
    <title>mantenimiento_de_hardware</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
                aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/mantenimiento_de_hardware/">
                <img src="<?= asset('./images/cit.png') ?>" width="35px'" alt="cit">
                Aplicaciones
            </a>
            <div class="collapse navbar-collapse" id="navbarToggler">
                
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin: 0;">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/mantenimiento_de_hardware/"><i
                                class="bi bi-house-fill me-2"></i>Inicio</a>
                    </li>

                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-gear me-2"></i>Mantenimientos
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" id="dropwdownRevision" style="margin: 0;">
                            <li>
                                <a class="dropdown-item nav-link text-black" href="/mantenimiento_de_hardware/marca">
                                    <i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Marca
                                </a>

                                <a class="dropdown-item nav-link text-black"
                                    href="/mantenimiento_de_hardware/equipo_estado">
                                    <i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Estado del Equipo
                                </a>
                                <a class="dropdown-item nav-link text-black"
                                    href="/mantenimiento_de_hardware/tipo_equipo">
                                    <i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Tipo de Equipos
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="nav-item d-flex">
                        <a class="dropdown-item nav-link text-white" href="/mantenimiento_de_hardware/solicitud">
                            <i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Formulario de Ingreso de Datos
                        </a>
                    </div>
                    <div class="nav-item d-flex">
                        <a class="dropdown-item nav-link text-white" href="/mantenimiento_de_hardware/mantenimientos">
                            <i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Equipo en Mantenimiento o
                            Reparación
                        </a>
                    </div>
                    <div class="nav-item d-flex">
                        <a class="dropdown-item nav-link text-white" href="/mantenimiento_de_hardware/mantenimientos2">
                            <i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Equipo Para Entregar
                        </a>
                    </div>
                    <div class="nav-item d-flex">
                        <a class="dropdown-item nav-link text-white" href="/mantenimiento_de_hardware/mantenimientos3">
                            <i class="ms-lg-0 ms-2 bi bi-plus-circle me-2"></i>Historial de Equipos
                        </a>
                    </div>
                </ul>
                <div class="col-lg-1 d-flex mb-lg-0 mb-2">
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
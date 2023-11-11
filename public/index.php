<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\EquipoController;
use Controllers\MarcaController;
use Controllers\TipoEquipoController;
use Controllers\Equipo_EstadoController;
use Controllers\ MantenimientoController;
use Controllers\ Mantenimiento2Controller;
use Controllers\ ReporteController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);
$router->get('/equipo', [EquipoController::class,'index']);

$router->post('/API/equipo/guardar', [EquipoController::class,'guardarAPI'] );


$router->get('/equipo', [EquipoController::class,'index']);
$router->get('/API/equipo/buscarCatalogo', [EquipoController::class,'buscarCatalogoApi']);
$router->get('/API/equipo/buscarCatalogo2', [EquipoController::class,'buscarCatalogo2Api']);

$router->get('/marca', [MarcaController::class,'index'] );
$router->post('/API/marca/guardar', [MarcaController::class,'guardarAPI'] );
$router->post('/API/marca/modificar', [MarcaController::class,'modificarAPI'] );
$router->post('/API/marca/eliminar', [MarcaController::class,'eliminarAPI'] );
$router->get('/API/marca/buscar', [MarcaController::class,'buscarAPI'] );

$router->get('/tipo_equipo', [TipoequipoController::class,'index'] );
$router->post('/API/tipo_equipo/guardar', [TipoequipoController::class,'guardarAPI'] );
$router->post('/API/tipo_equipo/modificar', [TipoequipoController::class,'modificarAPI'] );
$router->post('/API/tipo_equipo/eliminar', [TipoequipoController::class,'eliminarAPI'] );
$router->get('/API/tipo_equipo/buscar', [TipoequipoController::class,'buscarAPI'] );

$router->get('/equipo_estado', [Equipo_EstadoController::class,'index'] );
$router->post('/API/equipo_estado/guardar', [Equipo_EstadoController::class,'guardarAPI'] );
$router->post('/API/equipo_estado/modificar', [Equipo_EstadoController::class,'modificarAPI'] );
$router->post('/API/equipo_estado/eliminar', [Equipo_EstadoController::class,'eliminarAPI'] );
$router->get('/API/equipo_estado/buscar', [Equipo_EstadoController::class,'buscarAPI'] );

$router->get('/mantenimientos', [MantenimientoController::class,'index'] );
$router->get('/API/mantenimientos/buscar', [MantenimientoController::class,'buscarAPI'] );

$router->get('/mantenimientos2', [Mantenimiento2Controller::class,'index'] );
$router->get('/API/mantenimientos2/buscar', [Mantenimiento2Controller::class,'buscarAPI'] );
$router->post('/API/mantenimientos2/guardar', [Mantenimiento2Controller::class,'guardarAPI'] );



//reporte
$router->get('/pdf', [ReporteController::class,'pdf']);
$router->get('/reporte', [ReporteController::class, 'index']);
$router->get('/API/reporte/generar', [ReporteController::class, 'pdf']);
// $router->post('/API/equipo_estado/guardar', [Equipo_EstadoController::class,'guardarAPI'] );
// $router->post('/API/equipo_estado/modificar', [Equipo_EstadoController::class,'modificarAPI'] );
// $router->post('/API/equipo_estado/eliminar', [Equipo_EstadoController::class,'eliminarAPI'] );
// $router->get('/API/equipo_estado/buscar', [Equipo_EstadoController::class,'buscarAPI'] );


// $router->get('/dispositivos', [DispositivoController::class,'index']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

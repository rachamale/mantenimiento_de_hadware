<?php

namespace Controllers;

use Exception;
use Model\TipoEquipo;
use Model\Solicitud;
use MVC\Router;

class TipoequipoController { 
    public static function index(Router $router) {
        $tiposEquipo = TipoEquipo::all(); 
        $router->render('tipo_equipo/index', [ 
            'tiposEquipo' => $tiposEquipo, 
        ]);
    }

    public static function guardarAPI() {
        try {
            $tipoEquipo = new TipoEquipo($_POST); 

            $resultado = $tipoEquipo->crear(); 

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro guardado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function modificarAPI() {
        try {
            $tipoEquipo = new TipoEquipo($_POST);

            $resultado = $tipoEquipo->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro modificado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function eliminarAPI() {
        try {
            $tipo_equipo_codigo = $_POST['tipo_equipo_codigo']; 
            $tipoEquipo = TipoEquipo::find($tipo_equipo_codigo);
            $tipoEquipo->tipo_equipo_detalle_situacion = 0; 
            $resultado = $tipoEquipo->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Registro eliminado correctamente',
                    'codigo' => 1
                ]);
            } else {
                echo json_encode([
                    'mensaje' => 'Ocurrió un error',
                    'codigo' => 0
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarAPI() {
        $tipo_equipo_descripcion = $_GET['tipo_equipo_descripcion']; 

        $sql = "SELECT * FROM m_tipo_equipo WHERE tipo_equipo_detalle_situacion = 1 "; 
        if ($tipo_equipo_descripcion != '') {
            $sql .= " AND tipo_equipo_descripcion LIKE '%$tipo_equipo_descripcion%' ";
        }
        try {
            if (empty(Solicitud::consultarSQL($sql))) {
                echo json_encode([]);
            } else {
                $equipos = Solicitud::fetchArray($sql);
                echo json_encode($equipos);
            }
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}

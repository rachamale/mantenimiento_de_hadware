<?php

namespace Controllers;

use Exception;
use Model\Equipo_Estado;
use MVC\Router;

class Equipo_EstadoController {
    public static function index(Router $router) {
        $estados = Equipo_Estado::all();
        $router->render('equipo_estado/index', [
            'estados' => $estados,
        ]);
    }

    public static function guardarAPI() {
        try {
            $estado = new Equipo_Estado($_POST);
          
            $resultado = $estado->crear();

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
            $estado = new Equipo_Estado($_POST);

            $resultado = $estado->actualizar();

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
            $equipo_estado_codigo = $_POST['equipo_estado_codigo'];
            $estado = Equipo_Estado::find($equipo_estado_codigo);
            $estado->equipo_estado_detalle_situacion = 0;
            $resultado = $estado->actualizar();

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
        $equipo_estado_descripcion = $_GET['equipo_estado_descripcion'];

        $sql = "SELECT * FROM m_equipo_estado WHERE equipo_estado_detalle_situacion = 1 ";
        if ($equipo_estado_descripcion != '') {
            $sql .= " AND equipo_estado_descripcion LIKE '%$equipo_estado_descripcion%' ";
        }
        try {
            $estados = Equipo_Estado::fetchArray($sql);
            echo json_encode($estados);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}

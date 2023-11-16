<?php
namespace Controllers;

use Exception;
use Model\ActiveRecord;
use Model\Solicitud;
use Model\MarcaEquipo; // Cambio de Modelo
use MVC\Router;

class MarcaController {
    public static function index(Router $router) {
        $marcas = MarcaEquipo::all(); // Cambio de Modelo
        $router->render('marca/index', [
            'marcas' => $marcas,
        ]);
    }

    public static function guardarAPI() {
        try {
            $marca = new MarcaEquipo($_POST); // Cambio de Modelo

            $resultado = $marca->crear();

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
            $marca = new MarcaEquipo($_POST); // Cambio de Modelo

            $resultado = $marca->actualizar();

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
            $marca_equipo_codigo = $_POST['marca_equipo_codigo']; // Cambio de columna
            $marca = MarcaEquipo::find($marca_equipo_codigo); // Cambio de Modelo
            $marca->marca_equipo_situacion = 0; // Cambio de columna
            $resultado = $marca->actualizar();

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
        $marca_equipo_descripcion = $_GET['marca_equipo_descripcion']; // Cambio de columna

        $sql = "SELECT * FROM m_marca_equipo WHERE marca_equipo_situacion = 1 ";
        if ($marca_equipo_descripcion != '') {
            $sql .= " AND marca_equipo_descripcion LIKE '%$marca_equipo_descripcion%' "; // Cambio de columna
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

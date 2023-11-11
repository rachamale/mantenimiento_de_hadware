<?php

namespace Controllers;

use Exception;
use Model\Equipo;
use Model\TipoEquipo; // Cambio de "equipo" a "Equipo"
use MVC\Router;

class Mantenimiento2Controller
{

    public static function index(Router $router)
    {
        $TipoEquipo = static::TipoEquipo();
        $router->render('mantenimientos2/index', [
            'TipoEquipo' => $TipoEquipo,

        ]);
    }

    public static function TipoEquipo()
    {
        $sql = "SELECT * FROM m_tipo_equipo WHERE tipo_equipo_detalle_situacion = 1";

        try {
            $TipoEquipo = TipoEquipo::fetchArray($sql);
            return $TipoEquipo;
        } catch (Exception $e) {
            return [];
        }
    }

    public static function buscarAPI()
    {
        try {
            $tipo_equipo = $_GET['tipo_equipo'];

            $sql = "SELECT
                        ROW_NUMBER() OVER (ORDER BY e.equipo_codigo) AS NO,
                        e.equipo_codigo AS EQUIPO_CODIGO,
                        e.equipo_fecha_entrega AS FECHA,
                        trim(per.per_nom1) ||' '||trim(per.per_nom2)||' '||trim(per.per_ape1)||' '||trim(per.per_ape2) AS NOMBRE_USUARIO,
                        e.equipo_usuario_numero AS NUMERO_USUARIO,
                        e.equipo_tecnico_recibe AS TECNICO_RECIBE,
                        e.equipo_motivo AS MOTIVO,
                        te.tipo_equipo_descripcion AS TIPO_EQUIPO,
                        e.equipo_descripcion AS DESCRIPCION,
                        UPPER(es.equipo_estado_descripcion) AS ESTADO
                    FROM m_equipo e
                    LEFT JOIN m_equipo_estado es ON e.equipo_estado = es.equipo_estado_codigo
                    LEFT JOIN mper per ON per.per_catalogo = e.equipo_usuario_cat_entrega
                    LEFT JOIN m_tipo_equipo te ON te.tipo_equipo_codigo=e.equipo_tipo
                    WHERE e.equipo_estado = 3";
            if ($tipo_equipo != "") {
                $sql .= " and te.tipo_equipo_codigo = $tipo_equipo";
            }
            $equipos = TipoEquipo::fetchArray($sql); // Asumiendo que Equipo::fetchArray es una función para ejecutar la consulta y obtener un array de resultados.


            echo json_encode($equipos);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    public static function guardarAPI() {
        try {

            $equipo_fecha_entrega = $_POST['equipo_fecha_entrega'];
            $equipo_tecnico_entrega = $_POST['equipo_tecnico_entrega'];
            $equipo_usuario_cat_recibe = $_POST['equipo_usuario_cat_recibe'];
            $equipo = $_POST['equipo_codigo']; // Cambio de columna
            $equipo = Equipo::find($equipo); // Cambio de Modelo
            $equipo->equipo_estado = 4;
            $equipo->equipo_fecha_recibe = $equipo_fecha_entrega;            
            $equipo->equipo_tecnico_entrega = $equipo_tecnico_entrega;       
            $equipo->equipo_usuario_cat_recibe = $equipo_usuario_cat_recibe;
            $resultado = $equipo->actualizar();

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
}


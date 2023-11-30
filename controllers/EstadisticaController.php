<?php

namespace Controllers;

use Exception;
use Model\Equipo;
use Model\Reparacion;
use Model\Entrega;
use MVC\Router;

class EstadisticaController
{
    public static function index(Router $router)
    {
        $router->render('estadisticas/index', []);
    }


    public static function getDataAPI(Router $router)
    {
        $sql = "SELECT
                    COUNT(*) AS total_equipos,
                    CASE 
                        WHEN e.equipo_estado = 1 THEN 'Equipos Activos'
                        WHEN e.equipo_estado = 2 THEN 'Equipos en Reparacion'
                        WHEN e.equipo_estado = 3 THEN 'Equipos Reparados'
                    END estado
                FROM m_equipo e
                WHERE e.equipo_estado IN (1, 2, 3)
                group by equipo_estado";


        try {
            $resultados = Equipo::fetchArray($sql);
            echo json_encode($resultados);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);

        }
    }

    // FUNCION PARA MANDAR A LLAMAR LOS DATOS DEL QUINTO QUERY
    public static function buscarDatosEquiposDependencia()
    {
        $sql = "SELECT
                    e.equipo_dependencia,
                    e.equipo_dependencia || ' - ' || md.dep_desc_md AS nombre_y_numero_dependencia,
                    COUNT(*) AS cantidad_equipos
                FROM
                    m_equipo e
                JOIN
                    mdep md ON e.equipo_dependencia = md.dep_llave
                GROUP BY
                    e.equipo_dependencia, md.dep_desc_md;
                ";

                // SELECT
                //     md.dep_desc_md AS nombre_dependencia,
                //     COUNT(*) AS total_equipos,
                //     CASE 
                //         WHEN e.equipo_estado = 1 THEN 'Equipos Activos'
                //         WHEN e.equipo_estado = 2 THEN 'Equipos en Reparacion'
                //         WHEN e.equipo_estado = 3 THEN 'Equipos Reparados'
                //     END estado
                // FROM
                //     m_equipo e
                // JOIN
                //     mdep md ON e.equipo_dependencia = md.dep_llave
                // WHERE
                //     e.equipo_estado IN (1, 2, 3)
                // GROUP BY
                //     md.dep_desc_md, e.equipo_estado;

        try {
            $resultados = Equipo::fetchArray($sql);
            echo json_encode($resultados);
            error_log("Datos de equipos dependencia enviados con éxito");
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }


    public static function buscarDatosReparaciones()
    {
        $sql = "SELECT rep_tecnico_catalogo, COUNT(*) AS cantidad_reparaciones
                FROM m_reparacion
                GROUP BY rep_tecnico_catalogo";

        try {
            $resultados = Reparacion::fetchArray($sql);
            echo json_encode($resultados);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarDatosSolicitudes()
    {
        $sql = "SELECT sol_usuario_catalogo, COUNT(*) AS cantidad_solicitudes
                FROM m_solicitud
                GROUP BY sol_usuario_catalogo";

        try {
            $resultados = Reparacion::fetchArray($sql);
            echo json_encode($resultados);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarDatosEntregas()
    {
        $sql = "SELECT ent_usuario_catalogo, COUNT(*) AS cantidad_entregas
                FROM m_entrega
                GROUP BY ent_usuario_catalogo";

        try {
            $resultados = Reparacion::fetchArray($sql);
            echo json_encode($resultados);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    public static function buscarDatosMarcasEquipos()
    {
        $sql = "SELECT equipo_marca AS marca_equipo_codigo, COUNT(equipo_codigo) AS cantidad
                FROM m_equipo
                GROUP BY equipo_marca";

        try {
            $resultados = Equipo::fetchArray($sql);
            echo json_encode($resultados);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    // FUNCION PARA MANDAR A LLAMAR LOS DATOS DEL QUINTO QUERY
    public static function EstadisticaEntregasGeneral()
    {
    $sql = "SELECT
                e.ent_fecha AS fecha_entrega,
                e.ent_codigo AS codigo_entrega,
                e.ent_usuario_catalogo AS usuario_entrega,
                e.ent_tecnico_catalogo AS tecnico_entrega,
                e.ent_equipo_codigo AS codigo_equipo,
                eq.equipo_descripcion AS descripcion_equipo,
                eq.equipo_estado AS estado_equipo,
                eq.equipo_marca AS marca_equipo,
                eq.equipo_tipo AS tipo_equipo
            FROM
                m_entrega e
            JOIN
                m_equipo eq ON e.ent_equipo_codigo = eq.equipo_codigo
            ORDER BY
                e.ent_fecha DESC";

    try {
        $resultados = Entrega::fetchArray($sql); // Asegúrate de tener el método fetchArray en la clase Entrega
        echo json_encode($resultados);
    } catch (Exception $e) {
        echo json_encode([
            'detalle' => $e->getMessage(),
            'mensaje' => 'Ocurrió un error',
            'codigo' => 0
        ]);
    }
}



}
    



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
                    md.dep_desc_md AS nombre_dependencia,
                    COUNT(*) AS cantidad_equipos
                FROM
                    m_equipo e
                JOIN
                    mdep md ON e.equipo_dependencia = md.dep_llave
                GROUP BY
                    md.dep_desc_md";


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
        $sql = "SELECT 
                    TRIM(per2.per_nom1) || ' ' || TRIM(per2.per_nom2) || ' ' || TRIM(per2.per_ape1) || ' ' || TRIM(per2.per_ape2) AS nombre_tecnico,
                    r.rep_tecnico_catalogo,
                    COUNT(*) AS cantidad_reparaciones,
                    MAX(r.rep_fecha) AS ultima_reparacion
                FROM 
                    m_reparacion r
                LEFT JOIN 
                    mper per2 ON per2.per_catalogo = r.rep_tecnico_catalogo
                WHERE 
                    r.rep_equipo_codigo IN (
                        SELECT 
                            e.equipo_codigo
                        FROM 
                            m_equipo e
                        LEFT JOIN 
                            m_solicitud s ON s.sol_equipo_codigo = e.equipo_codigo
                        WHERE 
                            e.equipo_estado = 2
                    )
                GROUP BY 
                    nombre_tecnico, r.rep_tecnico_catalogo
                ORDER BY 
                    nombre_tecnico;";

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
        $sql = "SELECT 
                    TRIM(per.per_nom1) || ' ' || TRIM(per.per_nom2) || ' ' || TRIM(per.per_ape1) || ' ' || TRIM(per.per_ape2) AS nombre_usuario,
                    COUNT(*) AS cantidad_solicitudes
                FROM 
                    m_solicitud s
                LEFT JOIN 
                    mper per ON per.per_catalogo = s.sol_usuario_catalogo
                GROUP BY 
                    nombre_usuario, s.sol_usuario_catalogo
                ORDER BY 
                    nombre_usuario";

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
        $sql = "SELECT 
                    TRIM(per.per_nom1) || ' ' || TRIM(per.per_nom2) || ' ' || TRIM(per.per_ape1) || ' ' || TRIM(per.per_ape2) AS nombre_usuario,
                    COUNT(*) AS cantidad_entregas
                FROM 
                    m_entrega e
                LEFT JOIN 
                    mper per ON per.per_catalogo = e.ent_usuario_catalogo
                GROUP BY 
                    nombre_usuario, e.ent_usuario_catalogo
                ORDER BY 
                    nombre_usuario";

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
        $sql = "SELECT
                    mme.marca_equipo_descripcion AS marca_equipo,
                    COUNT(me.equipo_codigo) AS cantidad
                FROM
                    m_equipo me
                JOIN
                    m_marca_equipo mme ON me.equipo_marca = mme.marca_equipo_codigo
                GROUP BY
                    mme.marca_equipo_descripcion";

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
                    md.dep_desc_md AS nombre_dependencia,
                    COUNT(*) AS cantidad_equipos,
                    CASE 
                        WHEN e.equipo_estado = 1 THEN 'En Reparación'
                        WHEN e.equipo_estado = 2 THEN 'Listo para Entregar'
                        WHEN e.equipo_estado = 3 THEN 'Entregado'
                    END AS estado
                FROM
                    m_equipo e
                JOIN
                    mdep md ON e.equipo_dependencia = md.dep_llave
                WHERE
                    e.equipo_estado IN (1, 2, 3)
                GROUP BY
                    md.dep_desc_md, e.equipo_estado";

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

public static function buscarDatosEquiposPorEstado()
{
    $sql = "SELECT
                CASE
                    WHEN equipo_estado = 2 THEN 'Listo para Entregar'
                    WHEN equipo_estado = 3 THEN 'Entregado'
                    ELSE 'En Reparación'
                END AS estado_entrega,
                COUNT(*) AS cantidad
            FROM
                m_equipo
            GROUP BY
                estado_entrega";

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

public static function buscarDatosEquiposPorTipo()
{
    $sql = "SELECT
                md.dep_desc_md AS nombre_dependencia,
                te.tipo_equipo_descripcion AS tipo_equipo,
                COUNT(*) AS cantidad_equipos
            FROM
                m_equipo e
            JOIN
                m_tipo_equipo te ON e.equipo_tipo = te.tipo_equipo_codigo
            JOIN
                mdep md ON e.equipo_dependencia = md.dep_llave
            GROUP BY
                nombre_dependencia, tipo_equipo";

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



}
    



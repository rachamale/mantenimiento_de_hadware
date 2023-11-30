<?php

namespace Controllers;

use Exception;
use Model\Historial;
use MVC\Router;

class HistorialController
{
    public static function index(Router $router)
    {
        $historial = Historial::all();
        $router->render('historial/index', [
            'historial' => $historial,
        ]);
    }

    public static function buscarAPI()
    {
        $equi_his_codigo_equipo = $_GET['equi_his_codigo_equipo' ];
        $fechainicio = $_GET['fechaInicio' ];
        $fechafin = $_GET['fechaFin' ];

    

        $sql = "SELECT
                    e.equipo_oficio,
                    eh.equi_his_fecha, 
                    ee.equipo_estado_descripcion,
                    te.tipo_equipo_descripcion,                      
                    CASE WHEN eh.equi_his_estado between 1 and 3
                        then  s.sol_usuario_catalogo
                        else null
                    END sol_usuario_catalogo,
                    
                     CASE WHEN eh.equi_his_estado between 1 and 3
                        then s.sol_tecnico_catalogo
                        else null
                    END sol_tecnico_catalogo,
                    
                    CASE WHEN eh.equi_his_estado between 2 and 3
                        then r.rep_tecnico_catalogo
                        else null
                    END rep_tecnico_catalogo,
                    
                    CASE WHEN eh.equi_his_estado = 3
                        then en.ent_usuario_catalogo
                        else null
                    END ent_usuario_catalogo,
                    
                     CASE WHEN eh.equi_his_estado = 3
                        then en.ent_tecnico_catalogo
                        else null
                    END ent_tecnico_catalogo,
                    dep.dep_desc_lg
                FROM m_equipo_historial eh
                INNER JOIN m_equipo_estado ee ON eh.equi_his_estado = ee.equipo_estado_codigo
                INNER JOIN m_equipo e ON eh.equi_his_codigo_equipo = e.equipo_codigo
                INNER JOIN m_tipo_equipo te ON e.equipo_tipo = te.tipo_equipo_codigo
                LEFT JOIN m_solicitud s ON eh.equi_his_codigo_equipo = s.sol_equipo_codigo
                LEFT JOIN m_reparacion r ON eh.equi_his_codigo_equipo = r.rep_equipo_codigo
                LEFT JOIN mdep dep ON dep.dep_llave = e.equipo_dependencia
                LEFT JOIN m_entrega en ON eh.equi_his_codigo_equipo = en.ent_equipo_codigo
                WHERE eh.equi_his_situacion = 1
                AND CAST(eh.equi_his_fecha AS DATE) >= '$fechainicio'
                AND CAST(eh.equi_his_fecha AS DATE) <= '$fechafin'";
        
        if ($equi_his_codigo_equipo != '') {
            $sql .= " AND eh.equi_his_codigo_equipo = $equi_his_codigo_equipo";
        }

        try {
            if (empty(Historial::consultarSQL($sql))) {
                echo json_encode([]);
            } else {
                $historial = Historial::fetchArray($sql);
                echo json_encode($historial);
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

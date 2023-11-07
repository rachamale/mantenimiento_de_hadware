<?php

namespace Controllers;

use Exception;
use Model\Equipo;
use Model\TipoEquipo; // Cambio de "equipo" a "Equipo"
use MVC\Router;

class MantenimientoController { 

    public static function index(Router $router)
    {
        $TipoEquipo = static::TipoEquipo();
        $router->render('mantenimientos/index', [
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

    public static function buscarAPI() {
        $equipo_tipo = $_GET['equipo_tipo'];
        
        $sql = "SELECT
            ROW_NUMBER() OVER (ORDER BY e.equipo_codigo) AS NO,
            e.equipo_fecha AS FECHA,
            e.equipo_usuario_nombre AS NOMBRE_USUARIO,
            e.equipo_usuario_numero AS NUMERO_USUARIO,
            e.equipo_tecnico_recibe AS TECNICO_RECIBE,
            e.equipo_motivo AS MOTIVO,
            e.equipo_descripcion AS DESCRIPCION,
            es.equipo_estado_descripcion AS ESTADO
        FROM m_equipo e
        JOIN m_equipo_estado es ON e.equipo_estado = es.equipo_estado_codigo
        WHERE e.equipo_detalle_situacion = 1";
        
        if ($equipo_tipo != '') {
            $sql .= " AND e.equipo_tipo = '$equipo_tipo'";
        }
    
        try {
            $equipos = Equipo::fetchArray($sql);
            echo json_encode($equipos);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
    
    
}
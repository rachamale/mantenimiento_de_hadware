<?php

namespace Controllers;

use Exception;
use Model\Entrega;
use Model\Equipo;
use Model\Solicitud;
use Model\Reparacion;
use Model\Personal;
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
                        e.equipo_codigo AS EQUIPO_CODIGO,
                        s.sol_fecha AS FECHA,
                        r.rep_codigo AS REPARACION_CODIGO,
                        r.rep_notificacion AS NOTIFICACION,
                        trim(per.per_nom1) ||' '||trim(per.per_nom2)||' '||trim(per.per_ape1)||' '||trim(per.per_ape2) AS NOMBRE_USUARIO,
                        trim(per2.per_nom1) ||' '||trim(per2.per_nom2)||' '||trim(per2.per_ape1)||' '||trim(per2.per_ape2) AS NOMBRE_TECNICO,
                        s.sol_usuario_telefono AS TELEFONO_USUARIO,
                        s.sol_tecnico_catalogo AS TECNICO_RECIBIO,
                        e.equipo_motivo AS MOTIVO,
                        te.tipo_equipo_descripcion AS TIPO_EQUIPO,
                        e.equipo_descripcion AS DESCRIPCION,
                        UPPER(es.equipo_estado_descripcion) AS ESTADO
                    FROM m_equipo e
                    LEFT JOIN m_equipo_estado es ON e.equipo_estado = es.equipo_estado_codigo
                    LEFT JOIN m_solicitud s ON s.sol_equipo_codigo = e.equipo_codigo
                    LEFT JOIN mper per ON per.per_catalogo = s.sol_usuario_catalogo
                    LEFT JOIN mper per2 ON per2.per_catalogo = s.sol_tecnico_catalogo
                    LEFT JOIN m_tipo_equipo te ON te.tipo_equipo_codigo=e.equipo_tipo
                    INNER JOIN m_reparacion r on r.rep_equipo_codigo = e.equipo_codigo
                    WHERE e.equipo_estado = 2";
            if ($tipo_equipo != "") {
                $sql .= " and te.tipo_equipo_codigo = $tipo_equipo";
            }

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

    public static function buscarCatalogoApi()
    {
        $validarCatalogo = $_GET['ent_usuario_catalogo'];

        $sql = "SELECT  
                    dep_llave,
                    dep_desc_md,
                    org_plaza_desc,
                    per_grado, 
                    per_arma, 
                    per_catalogo,trim(per_nom1) ||' '||trim(per_nom2)||' '||trim(per_ape1)||' '||trim(per_ape2) as nombres 
                from mper, morg, mdep 
                where per_plaza = org_plaza 
                AND org_dependencia= dep_llave 
                and per_catalogo = $validarCatalogo";

        try {
            $resultado = Personal::fetchArray($sql);
            echo json_encode($resultado);

        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function buscarCatalogo2Api()
    {
        $validarCatalogo = $_GET['ent_tecnico_catalogo'];

        $sql = "SELECT  
                    dep_llave,
                    dep_desc_md,
                    org_plaza_desc,
                    per_grado, 
                    per_arma, 
                    per_catalogo,trim(per_nom1) ||' '||trim(per_nom2)||' '||trim(per_ape1)||' '||trim(per_ape2) as nombres 
                from mper, morg, mdep 
                where per_plaza = org_plaza 
                AND org_dependencia= dep_llave 
                and per_catalogo = $validarCatalogo";

        try {
            $resultado = Personal::fetchArray($sql);
            echo json_encode($resultado);

        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }


    public static function guardarAPI()
    {
        try {
            $entrega = new Entrega($_POST);
            $resultado_entrega = $entrega->crear();
            $id_resultado_entrega = $resultado_entrega['id'];
            if ($resultado_entrega['resultado'] == 1) {
                $rep_equipo = $_POST['ent_equipo_codigo'];
                $equipo = Equipo::find($rep_equipo);
                $equipo->equipo_estado = 3;
                $resultado_equipo = $equipo->actualizar();


                if ($resultado_equipo['resultado'] == 1) {

                    echo json_encode([
                        'mensaje' => 'El equipo ha sido entregado exitosamente.',
                        'codigo' => 1
                    ]);
                } else {
                    $entrega::SQL("DELETE m_entrega WHERE rep_codigo = $id_resultado_entrega");
                    echo json_encode([
                        'mensaje' => 'Ocurrió un error',
                        'codigo' => 0
                    ]);
                }
            }
        } catch (Exception $e) {

            $entrega::SQL("DELETE m_entrega WHERE rep_codigo = $id_resultado_entrega");
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

    public static function agregarNotificaciones() {
        try {
            $reperacion_codigo = $_POST['rep_codigo']; // Cambio de columna
            $Reperacion = Reparacion::find($reperacion_codigo); // Cambio de Modelo
            $Reperacion->rep_notificacion = $_POST['rep_notificacion'];; // Cambio de columna
            $resultado = $Reperacion->actualizar();

            if ($resultado['resultado'] == 1) {
                echo json_encode([
                    'mensaje' => 'Observación agregado correctamente',
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


<?php

namespace Controllers;

use Exception;
use Model\ActiveRecord;
use Model\Equipo;
use Model\Historial;
use Model\Personal;
use Model\Solicitud;
use Model\Reparacion;
use Model\TipoEquipo; // Cambio de "equipo" a "Equipo"
use MVC\Router;

class MantenimientoController
{

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

    public static function buscarAPI()
    {
        try {
            $tipo_equipo = $_GET['tipo_equipo'];

            $sql = "SELECT
                        e.equipo_codigo AS EQUIPO_CODIGO,
                        s.sol_codigo SOLICITUD_CODIGO,
                        s.sol_observacion OBSERVACION,
                        s.sol_fecha AS FECHA,
                        dep.dep_desc_lg AS DEPENDENCIA,
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
                    INNER JOIN m_solicitud s ON s.sol_equipo_codigo = e.equipo_codigo
                    LEFT JOIN mper per ON per.per_catalogo = s.sol_usuario_catalogo
                    LEFT JOIN mper per2 ON per2.per_catalogo = s.sol_tecnico_catalogo
                    LEFT JOIN m_tipo_equipo te ON te.tipo_equipo_codigo=e.equipo_tipo
                    LEFT JOIN mdep dep ON dep.dep_llave = e.equipo_dependencia
                    WHERE e.equipo_estado = 1";



            if ($tipo_equipo != "") {
                $sql .= " and te.tipo_equipo_codigo = $tipo_equipo";
            }
            if (empty(ActiveRecord::consultarSQL($sql))) {
                echo json_encode([]);
            } else {
                $equipos = ActiveRecord::fetchArray($sql);

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

    public static function buscarCatalogo2Api()
    {
        $validarCatalogo = $_GET['rep_tecnico_catalogo'];

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


    // public static function guardarAPI()
    // {
    //     try {
    //         $reparacion = new Reparacion($_POST);
    //         $resultado_reparacion = $reparacion->crear();
    //         $id_resultado_reparacion = $resultado_reparacion['id'];
    //         if ($resultado_reparacion['resultado'] == 1) {
    //             $rep_equipo = $_POST['rep_equipo_codigo'];
    //             $equipo = Equipo::find($rep_equipo);
    //             $equipo->equipo_estado = 2;
    //             $resultado_equipo = $equipo->actualizar();


    //             if ($resultado_equipo['resultado'] == 1) {
    //                 echo json_encode([
    //                     'mensaje' => 'El equipo ha sido reparado exitosamente.',
    //                     'codigo' => 1
    //                 ]);
    //             } else {
    //                 $reparacion::SQL("DELETE m_reparacion WHERE rep_codigo = $id_resultado_reparacion");
    //                 echo json_encode([
    //                     'mensaje' => 'Ocurrió un error',
    //                     'codigo' => 0
    //                 ]);
    //             }
    //         }
    //     } catch (Exception $e) {

    //         $reparacion::SQL("DELETE m_reparacion WHERE rep_codigo = $id_resultado_reparacion");
    //         echo json_encode([
    //             'detalle' => $e->getMessage(),
    //             'mensaje' => 'Ocurrió un error',
    //             'codigo' => 0
    //         ]);
    //     }
    // }
    public static function agregarObservacion()
    {
        try {
            $solicitud_codigo = $_POST['sol_codigo']; // Cambio de columna
            $Solicitud = Solicitud::find($solicitud_codigo); // Cambio de Modelo
            $Solicitud->sol_observacion = $_POST['sol_observacion'];
            ; // Cambio de columna
            $resultado = $Solicitud->actualizar();

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




    public static function guardarAPI()
    {
        try {
            $reparacion = new Reparacion($_POST);
            $resultado_reparacion = $reparacion->crear();
            $id_resultado_reparacion = $resultado_reparacion['id'];


            if ($resultado_reparacion['resultado'] == 1) {
                $rep_equipo = $_POST['rep_equipo_codigo'];
                $equipo = Equipo::find($rep_equipo);
                $equipo->equipo_estado = 2;
                $resultado_equipo = $equipo->actualizar();


                if ($resultado_equipo['resultado'] == 1) {
                    $arrayHistorial = array(
                        'equi_his_codigo_equipo' => $_POST['rep_equipo_codigo'],
                        'equi_his_estado' => 2
                    );


                    $historial = new Historial($arrayHistorial);
                    $resultado_historial = $historial->crear();


                    if ($resultado_historial['resultado'] == 1) {
                        echo json_encode([
                            'mensaje' => 'El equipo ha sido reparado exitosamente.',
                            'codigo' => 1
                        ]);
                    } else {
                        $reparacion::SQL("DELETE m_reparacion WHERE rep_codigo = $id_resultado_reparacion");
                        $equipo::SQL("UPDATE m_equipo SET equipo_estado = 1 WHERE equipo_codigo = $rep_equipo");
                        echo json_encode([
                            'mensaje' => 'Ocurrió un error',
                            'codigo' => 0
                        ]);
                    }
                } else {
                    $reparacion::SQL("DELETE m_reparacion WHERE rep_codigo = $id_resultado_reparacion");
                    echo json_encode([
                        'mensaje' => 'Ocurrió un error',
                        'codigo' => 0
                    ]);
                }
            }
        } catch (Exception $e) {
            $reparacion::SQL("DELETE m_reparacion WHERE rep_codigo = $id_resultado_reparacion");
            $equipo::SQL("UPDATE m_equipo SET equipo_estado = 1 WHERE equipo_codigo = $rep_equipo");
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}
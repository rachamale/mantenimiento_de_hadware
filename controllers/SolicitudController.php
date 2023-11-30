<?php

namespace Controllers;

use Exception;
use Model\Equipo;
use Model\Historial;
use Model\MarcaEquipo;
use Model\Solicitud;
use Model\TipoEquipo;
use MVC\Router;
use Model\Personal;

class SolicitudController
{
    public static function index(Router $router)
    {
        $marca = new MarcaEquipo();
        $marcas = $marca->getMarcas();
        $tipo = new TipoEquipo();
        $tipos = $tipo->getTiposEquipo();

        $router->render('solicitud/index', [
            'marcas' => $marcas,
            'tipos' => $tipos
        ]);
    }


    public static function buscarCatalogoApi()
    {
        $validarCatalogo = $_GET['per_catalogo'];

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
            $equipo = new Equipo($_POST);
            $resultado_equipo = $equipo->crear();

            if ($resultado_equipo['resultado'] == 1) {
                $equipo_codigo = $resultado_equipo['id'];

                $solicitud = new Solicitud($_POST);
                $solicitud->sol_equipo_codigo = $equipo_codigo;
                $resultado_solicitud = $solicitud->crear();

                if ($resultado_solicitud['resultado'] == 1) {
                    $arrayHistorial = array(
                        'equi_his_codigo_equipo' => $equipo_codigo,
                        'equi_his_estado' => 1
                    );


                    $historial = new Historial($arrayHistorial);
                    $resultado_historial = $historial->crear();


                    if ($resultado_historial['resultado'] == 1) {
                        echo json_encode([
                            'mensaje' => 'Registro guardado correctamente',
                            'codigo' => 1,
                            'equipo' => $equipo_codigo
                        ]);
                    } else {
                        $equipo::SQL("DELETE m_equipo WHERE equipo_codigo = $equipo_codigo");
                        $solicitud::SQL("DELETE m_solicitud WHERE equipo_codigo = " . $resultado_solicitud['resultado']);
                        echo json_encode([
                            'mensaje' => 'Ocurrió un error',
                            'codigo' => 0
                        ]);
                    }
                } else {
                    $equipo::SQL("DELETE m_equipo WHERE equipo_codigo = $equipo_codigo");
                    echo json_encode([
                        'mensaje' => 'Ocurrió un error',
                        'codigo' => 0
                    ]);
                }
            }
        } catch (Exception $e) {
            $equipo::SQL("DELETE m_equipo WHERE equipo_codigo = $equipo_codigo");
            $solicitud::SQL("DELETE m_solicitud WHERE equipo_codigo = " . $resultado_solicitud['resultado']);
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }

}
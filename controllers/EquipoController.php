<?php

namespace Controllers;

use Exception;
use Model\Equipo;
use Model\MarcaEquipo;
use Model\TipoEquipo;
use MVC\Router;
use Model\Personal;

class EquipoController
{
    public static function index(Router $router)
    {
        $marca = new MarcaEquipo();
        $marcas = $marca->getMarcas();
        $tipo = new TipoEquipo();
        $tipos = $tipo->getTiposEquipo();

        $router->render('equipo/index', [
            'marcas' => $marcas,
            'tipos' => $tipos
        ]);
    }

    public static function buscarCatalogoApi()
    {
        $validarCatalogo = $_GET['per_catalogo'];

        $sql = "SELECT  dep_llave,dep_desc_md,org_plaza_desc,per_grado, per_arma, per_catalogo,trim(per_nom1) ||' '||trim(per_nom2)||' '||trim(per_ape1)||' '||trim(per_ape2) as nombres from mper, morg, mdep where per_plaza = org_plaza AND org_dependencia= dep_llave and per_catalogo = $validarCatalogo ";


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
        $validarCatalogo2 = $_GET['per_catalogo'];


        $sql = "SELECT  dep_llave,dep_desc_md,org_plaza_desc,per_grado, per_arma, per_catalogo,trim(per_nom1) ||' '||trim(per_nom2)||' '||trim(per_ape1)||' '||trim(per_ape2) as nombres from mper, morg, mdep where per_plaza = org_plaza AND org_dependencia= dep_llave and per_catalogo = $validarCatalogo2 ";


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

            $resultado = $equipo->crear();

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

}
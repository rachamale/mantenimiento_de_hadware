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
        $router->render('equipo/index', []);
    }

}
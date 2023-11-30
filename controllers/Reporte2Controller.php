<?php

namespace Controllers;

use Model\Equipo;
use Mpdf\Mpdf;
use MVC\Router;

class Reporte2Controller
{

    public static function pdf2(Router $router)
    {
        $equipo_id= $_GET['equipo_codigo']; 

        $datos = self::informacion($equipo_id);

        $mpdf = new Mpdf([
            "orientation" => "P",
            "default_font_size" => 12,
            "default_font" => "arial",
            "format" => "Legal",
            "mode" => 'utf-8'
        ]);

        $mpdf->SetMargins(30, 35, 25);

        $html = $router->load('reporte2/pdf2', [
            'solicitud' => $datos[0],
        ]);

        $htmlFooter = $router->load('reporte2/footer2');
        $mpdf->SetHTMLFooter($htmlFooter);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public static function informacion($id_equipo)
    {


        $sql = "SELECT FIRST 1
        s.sol_fecha AS FECHA,
        e.equipo_codigo AS REGISTRO,
        e.equipo_oficio AS OFICIO,
        s.sol_usuario_catalogo AS CATALOGO_USUARIO,
        TRIM(per.per_nom1) ||' '||TRIM(per.per_nom2)||' '||TRIM(per.per_ape1)||' '||TRIM(per.per_ape2) AS USUARIO,
        s.sol_usuario_telefono AS TELEFONO,
        s.sol_tecnico_catalogo AS CATALOGO_TECNICO,
        TRIM(tec.per_nom1) ||' '||TRIM(tec.per_nom2)||' '||TRIM(tec.per_ape1)||' '||TRIM(tec.per_ape2) AS TECNICO,
        mar.marca_equipo_descripcion AS MARCA,
        e.equipo_modelo AS MODELO,
        e.equipo_serial AS SERIE,
        dep.dep_desc_lg AS DEPENDENCIA,
        tip.tipo_equipo_descripcion AS TIPO_EQUIPO
    FROM m_equipo e
    LEFT JOIN m_solicitud s ON s.sol_equipo_codigo = e.equipo_codigo
    LEFT JOIN mper per ON per.per_catalogo = s.sol_usuario_catalogo
    LEFT JOIN mper tec ON tec.per_catalogo = s.sol_tecnico_catalogo
    LEFT JOIN m_marca_equipo mar ON e.equipo_marca = mar.marca_equipo_codigo
    LEFT JOIN mdep dep ON dep.dep_llave = e.equipo_dependencia
    LEFT JOIN m_tipo_equipo tip ON e.equipo_tipo = tip.tipo_equipo_codigo
    where e.equipo_codigo = $id_equipo";

        return $solicitud = Equipo::fetchArray($sql);



    }
}
<?php

namespace Controllers;

use Model\Equipo;
use Mpdf\Mpdf;
use MVC\Router;


class ReporteController {
    
    public static function pdf (Router $router){
        $equipo_id= $_GET['equipo_codigo']; 
        
        $objetoEquipo= new Equipo();
        $equipo = $objetoEquipo->getEquipo($equipo_id);
    
        $mpdf = new Mpdf([
            "orientation" => "P",
            "default_font_size" => 12,
            "default_font" => "arial",
            "format" => "Legal",
            "mode" => 'utf-8'
        ]);
        $mpdf->SetMargins(10,35,10);

        $html = $router->load('reporte/pdf',[
            'equipo'=> $equipo[0],
        ]);

        $htmlFooter = $router->load('reporte/footer');
        $mpdf->SetHTMLFooter($htmlFooter);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}

<?php

namespace Model;

class MarcaEquipo extends ActiveRecord { // Cambio del nombre de la clase
    protected static $tabla = 'm_marca_equipo'; // Cambio del nombre de la tabla
    protected static $columnasDB = ['marca_equipo_descripcion', 'marca_equipo_situacion']; // Cambio de columnas
    protected static $idTabla = 'marca_equipo_codigo'; // Cambio del nombre de la clave primaria

    public $marca_equipo_codigo; // Cambio de nombre de propiedad
    public $marca_equipo_descripcion;
    public $marca_equipo_situacion;

    public function __construct($args = []) {
        $this->marca_equipo_codigo = $args['marca_equipo_codigo'] ?? null; // Cambio de nombre de propiedad
        $this->marca_equipo_descripcion = $args['marca_equipo_descripcion'] ?? '';
        $this->marca_equipo_situacion = $args['marca_equipo_situacion'] ?? 1; // Valor por defecto
    }

    public function getMarcas(){
        $sql = "SELECT  * from m_marca_equipo where marca_equipo_situacion = 1";
        return $this->fetchArray($sql);
    }
}

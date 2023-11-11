<?php
namespace Model;

class TipoEquipo extends ActiveRecord {
    protected static $tabla = 'm_tipo_equipo';
    protected static $columnasDB = ['tipo_equipo_descripcion', 'tipo_equipo_detalle_situacion'];
    protected static $idTabla = 'tipo_equipo_codigo';

    public $tipo_equipo_codigo;
    public $tipo_equipo_descripcion;
    public $tipo_equipo_detalle_situacion;

    public function __construct($args = []) {
        $this->tipo_equipo_codigo = $args['tipo_equipo_codigo'] ?? null;
        $this->tipo_equipo_descripcion = $args['tipo_equipo_descripcion'] ?? '';
        $this->tipo_equipo_detalle_situacion = $args['tipo_equipo_detalle_situacion'] ?? 1;
    }

    public function getTiposEquipo(){
        $sql = "SELECT * from m_tipo_equipo where tipo_equipo_detalle_situacion = 1";
        return $this->fetchArray($sql);
    }
}

<?php
namespace Model;

class Equipo_Estado extends ActiveRecord {

    protected static $tabla = 'm_equipo_estado';
    protected static $columnasDB = ['equipo_estado_descripcion', 'equipo_estado_detalle_situacion'];
    protected static $idTabla = 'equipo_estado_codigo';

    public $equipo_estado_codigo;
    public $equipo_estado_descripcion;
    public $equipo_estado_detalle_situacion;

    public function __construct($args = []) {
        $this->equipo_estado_codigo = $args['equipo_estado_codigo'] ?? null;
        $this->equipo_estado_descripcion = $args['equipo_estado_descripcion'] ?? '';
        $this->equipo_estado_detalle_situacion = $args['equipo_estado_detalle_situacion'] ?? 1;
    }
}

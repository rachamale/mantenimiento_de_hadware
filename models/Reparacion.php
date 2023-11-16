<?php

namespace Model;

class Reparacion extends ActiveRecord {
    protected static $tabla = 'm_reparacion';
    protected static $columnasDB = ['rep_fecha', 'rep_tecnico_catalogo', 'rep_descripcion', 'rep_detalle_situacion', 'rep_equipo_codigo'];
    protected static $idTabla = 'rep_codigo';

    public $rep_codigo;
    public $rep_fecha;
    public $rep_tecnico_catalogo;
    public $rep_descripcion;
    public $rep_detalle_situacion;
    public $rep_equipo_codigo;

    public function __construct($args = []) {
        $this->rep_codigo = $args['rep_codigo'] ?? null;
        $this->rep_fecha = $args['rep_fecha'] ?? '';
        $this->rep_tecnico_catalogo = $args['rep_tecnico_catalogo'] ?? null;
            $this->rep_descripcion = utf8_decode( $args['rep_descripcion'] )?? '';
        $this->rep_detalle_situacion = $args['rep_detalle_situacion'] ?? 1;
        $this->rep_equipo_codigo = $args['rep_equipo_codigo'] ?? null;
    }

    // Puedes agregar métodos adicionales según sea necesario.
}

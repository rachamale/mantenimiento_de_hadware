<?php

namespace Model;

class Solicitud extends ActiveRecord {
    protected static $tabla = 'm_solicitud';
    protected static $columnasDB = ['sol_fecha', 'sol_usuario_catalogo', 'sol_usuario_telefono', 'sol_tecnico_catalogo', 'sol_detalle_situacion', 'sol_equipo_codigo'];
    protected static $idTabla = 'sol_codigo';

    public $sol_codigo;
    public $sol_fecha;
    public $sol_usuario_catalogo;
    public $sol_usuario_telefono;
    public $sol_tecnico_catalogo;
    public $sol_detalle_situacion;
    public $sol_equipo_codigo;

    public function __construct($args = []) {
        $this->sol_codigo = $args['sol_codigo'] ?? null;
        $this->sol_fecha = $args['sol_fecha'] ?? '';
        $this->sol_usuario_catalogo = $args['sol_usuario_catalogo'] ?? null;
        $this->sol_usuario_telefono = $args['sol_usuario_telefono'] ?? null;
        $this->sol_tecnico_catalogo = $args['sol_tecnico_catalogo'] ?? null;
        $this->sol_detalle_situacion = $args['sol_detalle_situacion'] ?? 1;
        $this->sol_equipo_codigo = $args['sol_equipo_codigo'] ?? null;
    }

    // Puedes agregar métodos adicionales según sea necesario.
}

<?php

namespace Model;

class Entrega extends ActiveRecord {
    protected static $tabla = 'm_entrega';
    protected static $columnasDB = [ 'ent_usuario_catalogo', 'ent_usuario_numero', 'ent_tecnico_catalogo', 'ent_detalle_situacion', 'ent_equipo_codigo'];
    protected static $idTabla = 'ent_codigo';

    public $ent_codigo;
    public $ent_usuario_catalogo;
    public $ent_usuario_numero;
    public $ent_tecnico_catalogo;
    public $ent_detalle_situacion;
    public $ent_equipo_codigo;

    public function __construct($args = []) {
        $this->ent_codigo = $args['ent_codigo'] ?? null;
        $this->ent_usuario_catalogo = $args['ent_usuario_catalogo'] ?? null;
        $this->ent_usuario_numero = $args['ent_usuario_numero'] ?? null;
        $this->ent_tecnico_catalogo = $args['ent_tecnico_catalogo'] ?? null;
        $this->ent_detalle_situacion = $args['ent_detalle_situacion'] ?? 1;
        $this->ent_equipo_codigo = $args['ent_equipo_codigo'] ?? null;
    }

    // Puedes agregar métodos adicionales según sea necesario.
}

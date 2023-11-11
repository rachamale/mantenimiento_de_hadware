<?php

namespace Model;

class Equipo extends ActiveRecord
{
    protected static $tabla = 'm_equipo';
    protected static $columnasDB = [
        'equipo_fecha_entrega',
        'equipo_fecha_recibe',
        'equipo_oficio',
        'equipo_usuario_cat_entrega',
        'equipo_usuario_cat_recibe',
        'equipo_usuario_numero',
        'equipo_dependencia',
        'equipo_motivo',
        'equipo_modelo',
        'equipo_serial',
        'equipo_almacenamiento',
        'equipo_lector_cd',
        'equipo_tarjeta_sonido',
        'equipo_drivers',
        'equipo_tarjeta_grafica',
        'equipo_fuente_poder',
        'equipo_con_cable',
        'equipo_marca',
        'equipo_tipo',
        'equipo_descripcion',
        'equipo_tecnico_recibe',
        'equipo_tecnico_entrega',
        'equipo_estado',
        'equipo_detalle_situacion',
    ];
    
    protected static $idTabla = 'equipo_codigo';
    
    public $equipo_codigo;
    public $equipo_fecha_entrega;
    public $equipo_fecha_recibe;
    public $equipo_oficio;
    public $equipo_usuario_cat_entrega;
    public $equipo_usuario_cat_recibe;
    public $equipo_usuario_nombre;
    public $equipo_usuario_numero;
    public $equipo_dependencia;
    public $equipo_motivo;
    public $equipo_modelo;
    public $equipo_serial;
    public $equipo_almacenamiento;
    public $equipo_lector_cd;
    public $equipo_tarjeta_sonido;
    public $equipo_drivers;
    public $equipo_tarjeta_grafica;
    public $equipo_fuente_poder;
    public $equipo_con_cable;
    public $equipo_marca;
    public $equipo_tipo;
    public $equipo_descripcion;
    public $equipo_tecnico_recibe;
    public $equipo_tecnico_entrega;
    public $equipo_estado;
    public $equipo_detalle_situacion;
    
    // Constructor
    public function __construct($args = [])
    {
        $this->equipo_codigo = $args['equipo_codigo'] ?? null;
        $this->equipo_fecha_recibe = $args['equipo_fecha_recibe'] ?? '';
        $this->equipo_fecha_entrega = $args['equipo_fecha_entrega'] ?? '';
        $this->equipo_oficio = $args['equipo_oficio'] ?? '';
        $this->equipo_usuario_cat_recibe = $args['equipo_usuario_cat_recibe'] ?? '';
        $this->equipo_usuario_cat_entrega = $args['equipo_usuario_cat_entrega'] ?? '';
        $this->equipo_usuario_numero = $args['equipo_usuario_numero'] ?? '';
        $this->equipo_dependencia = $args['equipo_dependencia'] ?? '';
        $this->equipo_motivo = $args['equipo_motivo'] ?? '';
        $this->equipo_modelo = $args['equipo_modelo'] ?? '';
        $this->equipo_serial = $args['equipo_serial'] ?? '';
        $this->equipo_almacenamiento = $args['equipo_almacenamiento'] ?? null;
        $this->equipo_lector_cd = $args['equipo_lector_cd'] ?? NULL;
        $this->equipo_tarjeta_sonido = $args['equipo_tarjeta_sonido'] ?? null;
        $this->equipo_drivers = $args['equipo_drivers'] ?? null;
        $this->equipo_tarjeta_grafica = $args['equipo_tarjeta_grafica'] ?? null;
        $this->equipo_fuente_poder = $args['equipo_fuente_poder'] ?? null;
        $this->equipo_con_cable = $args['equipo_con_cable'] ?? null;
        $this->equipo_marca = $args['equipo_marca'] ?? '';
        $this->equipo_tipo = $args['equipo_tipo'] ?? '';
        $this->equipo_descripcion = $args['equipo_descripcion'] ?? '';
        $this->equipo_tecnico_recibe = $args['equipo_tecnico_recibe'] ?? null;
        $this->equipo_tecnico_entrega = $args['equipo_tecnico_entrega'] ?? null;
        $this->equipo_estado = $args['equipo_estado'] ?? 1;
        $this->equipo_detalle_situacion = $args['equipo_detalle_situacion'] ?? 1;
    }
}

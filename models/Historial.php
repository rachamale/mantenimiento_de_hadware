<?php

namespace Model;

class Historial extends ActiveRecord
{
    protected static $tabla = 'm_equipo_historial';
    protected static $columnasDB = [
        'equi_his_codigo_equipo',
        // 'equi_his_codigo_solicitud',
        'equi_his_estado',
        'equi_his_situacion',
    ];

    protected static $idTabla = 'equi_his_codigo';

    public $equi_his_codigo;
    public $equi_his_codigo_equipo;
    // public $equi_his_codigo_solicitud;
    public $equi_his_estado;
    public $equi_his_situacion;

    public function __construct($args = [])
    {
        $this->equi_his_codigo = $args['equi_his_codigo'] ?? null;
        $this->equi_his_codigo_equipo = $args['equi_his_codigo_equipo'] ?? '';
        // $this->equi_his_codigo_solicitud = $args['equi_his_codigo_solicitud'] ?? ''; 
        $this->equi_his_estado = $args['equi_his_estado'] ?? '';
        $this->equi_his_situacion = $args['equi_his_situacion'] ?? 1;
    }
}

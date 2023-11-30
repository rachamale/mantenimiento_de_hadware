<?php

namespace Model;

class Equipo extends ActiveRecord
{
    protected static $tabla = 'm_equipo';
    protected static $columnasDB = [
        'equipo_oficio',
        'equipo_dependencia',
        'equipo_motivo',
        'equipo_modelo',
        'equipo_serial',
        'equipo_lector_cd',
        'equipo_tarjeta_sonido',
        'equipo_drivers',
        'equipo_tarjeta_grafica',
        'equipo_fuente_poder',
        'equipo_con_cable',
        'equipo_marca',
        'equipo_tipo',
        'equipo_descripcion',
        'equipo_estado',
        'equipo_detalle_situacion',
        'equipo_tipo_disco_duro',
        'equipo_capacidad_disco_duro',
        'equipo_tipo_memoria_ram',
        'equipo_capacidad_memoria_ram',
        'equipo_velocidad_memoria_ram',
        'equipo_tipo_procesador',
        'equipo_velocidad_procesador',
        'equipo_targeta_red',
        'equipo_tipo_impresora',
    ];

    protected static $idTabla = 'equipo_codigo';

    public $equipo_codigo;
    public $equipo_oficio;
    public $equipo_dependencia;
    public $equipo_motivo;
    public $equipo_modelo;
    public $equipo_serial;
    public $equipo_lector_cd;
    public $equipo_tarjeta_sonido;
    public $equipo_drivers;
    public $equipo_tarjeta_grafica;
    public $equipo_fuente_poder;
    public $equipo_con_cable;
    public $equipo_marca;
    public $equipo_tipo;
    public $equipo_descripcion;
    public $equipo_estado;
    public $equipo_detalle_situacion;

    // Nuevos campos
    public $equipo_tipo_disco_duro;
    public $equipo_capacidad_disco_duro;
    public $equipo_tipo_memoria_ram;
    public $equipo_capacidad_memoria_ram;
    public $equipo_velocidad_memoria_ram;
    public $equipo_tipo_procesador;
    public $equipo_velocidad_procesador;
    public $equipo_targeta_red;
    public $equipo_tipo_impresora;

    // Constructor
    public function __construct($args = [])
    {
        $this->equipo_codigo = $args['equipo_codigo'] ?? null;
        $this->equipo_oficio = $args['equipo_oficio'] ?? '';
        $this->equipo_dependencia = $args['equipo_dependencia'] ?? '';
        $this->equipo_motivo = $args['equipo_motivo'] ?? '';
        $this->equipo_modelo = $args['equipo_modelo'] ?? '';
        $this->equipo_serial = $args['equipo_serial'] ?? '';
        $this->equipo_lector_cd = $args['equipo_lector_cd'] ?? NULL;
        $this->equipo_tarjeta_sonido = $args['equipo_tarjeta_sonido'] ?? null;
        $this->equipo_drivers = $args['equipo_drivers'] ?? null;
        $this->equipo_tarjeta_grafica = $args['equipo_tarjeta_grafica'] ?? null;
        $this->equipo_fuente_poder = $args['equipo_fuente_poder'] ?? null;
        $this->equipo_con_cable = $args['equipo_con_cable'] ?? null;
        $this->equipo_marca = $args['equipo_marca'] ?? '';
        $this->equipo_tipo = $args['equipo_tipo'] ?? '';
        $this->equipo_descripcion = $args['equipo_descripcion'] ?? '';
        $this->equipo_estado = $args['equipo_estado'] ?? 1;
        $this->equipo_detalle_situacion = $args['equipo_detalle_situacion'] ?? 1;

        // Nuevos campos
        $this->equipo_tipo_disco_duro = $args['equipo_tipo_disco_duro'] ?? '';
        $this->equipo_capacidad_disco_duro = $args['equipo_capacidad_disco_duro'] ?? '';
        $this->equipo_tipo_memoria_ram = $args['equipo_tipo_memoria_ram'] ?? '';
        $this->equipo_capacidad_memoria_ram = $args['equipo_capacidad_memoria_ram'] ?? '';
        $this->equipo_velocidad_memoria_ram = $args['equipo_velocidad_memoria_ram'] ?? '';
        $this->equipo_tipo_procesador = $args['equipo_tipo_procesador'] ?? '';
        $this->equipo_velocidad_procesador = $args['equipo_velocidad_procesador'] ?? '';
        $this->equipo_targeta_red = $args['equipo_targeta_red'] ?? '';
        $this->equipo_tipo_impresora = $args['equipo_tipo_impresora'] ?? '';
    }

    public function getEquipo($equipo_codigo)
    {
        $sql = "    SELECT                            
                        me.ent_fecha AS FECHA,
                        e.equipo_codigo AS REGISTRO,
                        e.equipo_oficio AS OFICIO,
                        me.ent_usuario_catalogo AS CATALOGO_USUARIO,
                        trim(per.per_nom1) ||' '||trim(per.per_nom2)||' '||trim(per.per_ape1)||' '||trim(per.per_ape2) AS USUARIO,
                        s.sol_usuario_telefono AS TELEFONO,
                        me.ent_tecnico_catalogo AS CATALOGO_TECNICO,
                        trim(tec.per_nom1) ||' '||trim(tec.per_nom2)||' '||trim(tec.per_ape1)||' '||trim(tec.per_ape2) AS TECNICO,
                        mar.marca_equipo_descripcion AS MARCA,
                        e.equipo_modelo AS MODELO,
                        e.equipo_serial AS SERIE,
                        rep.rep_descripcion TRABAJO,
                        dep.dep_desc_lg AS DEPENDENCIA
                    FROM m_equipo e
                    LEFT JOIN m_entrega me ON me.ent_equipo_codigo=e.equipo_codigo
                    LEFT JOIN m_solicitud s ON s.sol_equipo_codigo = e.equipo_codigo
                    LEFT JOIN m_reparacion rep ON rep.rep_equipo_codigo=e.equipo_codigo
                    LEFT JOIN mper per ON per.per_catalogo = me.ent_usuario_catalogo
                    LEFT JOIN mper tec ON tec.per_catalogo = me.ent_tecnico_catalogo
                    LEFT JOIN m_marca_equipo mar ON e.equipo_marca = mar.marca_equipo_codigo
                    LEFT JOIN mdep dep ON dep.dep_llave = e.equipo_dependencia  
                    WHERE e.equipo_estado = 3
                    AND e.equipo_codigo = $equipo_codigo";
                    return $this->fetchArray($sql);
    }

}
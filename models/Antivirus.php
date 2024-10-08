<?php

namespace Model;

class Operacion extends ActiveRecord
{
    protected static $tabla = 'antivirus';
    protected static $idTabla = 'antivirus_id';

    protected static $columnasDB = ['antivirus_nombre', 'antivirus_descripcion','antivirus_dependencia', 'antivirus_direccion', 'antivirus_ubicacion', 'antivirus_cantidad', 'antivirus_fecha', 'antivirus_situacion'];

    public $antivirus_id;
    public $antivirus_nombre;
    public $antivirus_descripcion;
    public $antivirus_dependencia;
    public $antivirus_direccion;
    public $antivirus_ubicacion;
    public $antivirus_cantidad;
    public $antivirus_fecha;
    public $antivirus_situacion;

    public function __construct($args = [])
    {
        $this->antivirus_id = $args['antivirus_id'] ?? '';
        $this->antivirus_nombre = $args['antivirus_nombre'] ?? '';
        $this->antivirus_descripcion = $args['antivirus_descripcion'] ?? '';
        $this->antivirus_dependencia = $args['antivirus_dependencia'] ?? '';
        $this->antivirus_direccion = $args['antivirus_direccion'] ?? '';
        $this->antivirus_ubicacion = $args['antivirus_ubicacion'] ?? '';
        $this->antivirus_cantidad = $args['antivirus_cantidad'] ?? 0;
        $this->antivirus_fecha = $args['antivirus_fecha'] ?? '';
        $this->antivirus_situacion = $args['antivirus_situacion'] ?? 1;
    }

    // public static function buscar()
    // {
    //     $sql = "SELECT * FROM antivirus where antivirus_situacion = 1";
    //     return self::fetchArray($sql);
    // }

    public static function obtenerAntivirusconQuery()
    {
        $sql = "SELECT 
                    antivirus_id,
                    antivirus_nombre,
                    antivirus_descripcion,
                    dependencia_nombre,
                    antivirus_direccion,
                    antivirus_ubicacion,
                    antivirus_cantidad,
                    antivirus_fecha
                FROM 
                    antivirus
                JOIN 
                    dependencias ON antivirus_dependencia = dependencia_id
                WHERE
                antivirus_situacion = 1";
        return self::fetchArray($sql);
    }

}
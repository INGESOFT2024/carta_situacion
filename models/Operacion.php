<?php

namespace Model;

class Operacion extends ActiveRecord
{
    protected static $tabla = 'operaciones';
    protected static $idTabla = 'operaciones_id';

    protected static $columnasDB = ['operacion_nombre', 'operacion_descripcion','operacion_dependencia', 'operacion_direccion', 'operacion_ubicacion', 'operacion_cantidad', 'operacion_fecha', 'operacion_situacion'];

    public $operacion_id;
    public $operacion_nombre;
    public $operacion_descripcion;
    public $operacion_dependencia;
    public $operacion_direccion;
    public $operacion_ubicacion;
    public $operacion_cantidad;
    public $operacion_fecha;
    public $operacion_situacion;

    public function __construct($args = [])
    {
        $this->operacion_id = $args['operacion_id'] ?? '';
        $this->operacion_nombre = $args['operacion_nombre'] ?? '';
        $this->operacion_descripcion = $args['operacion_descripcion'] ?? '';
        $this->operacion_dependencia = $args['operacion_dependencia'] ?? '';
        $this->operacion_direccion = $args['operacion_direccion'] ?? '';
        $this->operacion_ubicacion = $args['operacion_ubicacion'] ?? '';
        $this->operacion_cantidad = $args['operacion_cantidad'] ?? 0;
        $this->operacion_fecha = $args['operacion_fecha'] ?? '';
        $this->operacion_situacion = $args['operacion_situacion'] ?? 1;
    }

    public static function buscar()
    {
        $sql = "SELECT * FROM operaciones where operacion_situacion = 1";
        return self::fetchArray($sql);
    }

}
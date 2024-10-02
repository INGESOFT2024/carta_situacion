<?php

namespace Model;

class Dependencia extends ActiveRecord
{
    protected static $tabla = 'dependencias';
    protected static $idTabla = 'dependencia_id';

    protected static $columnasDB = ['dependencia_nombre', 'dependencia_situacion'];

    public $dependencia_id;
    public $dependencia_nombre;
    public $dependencia_situacion;

    public function __construct($args = [])
    {
        $this->dependencia_id = $args['dependencia_id'] ?? '';
        $this->dependencia_nombre = $args['dependencia_nombre'] ?? '';
        $this->dependencia_situacion = $args['dependencia_situacion'] ?? 1;
    }

    public static function buscar()
    {
        $sql = "SELECT * FROM dependencias where dependencia_situacion = 1";
        return self::fetchArray($sql);
    }

    public static function obtenerDependenciasconQuery()
    {
        $sql = "SELECT * FROM dependencias where dependencia_situacion = 1";
        return self::fetchArray($sql);
    }

}
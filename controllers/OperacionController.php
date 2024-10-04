<?php

namespace Controllers;

use Exception;
use Model\Operacion;
use MVC\Router;

class OperacionController
{
    public static function index(Router $router)
    {
        $operaciones = Operacion::find(2);
        $router->render('operaciones/index', [
            'operaciones' => $operaciones
        ]);
    }

    public static function index3(Router $router)
    {
        $operaciones = Operacion::find(2);
        $router->render('operaciones/mapa', [
            'operaciones' => $operaciones
        ]);
    }
    
    

    public static function guardarAPI()
    {
        $_POST['operacion_nombre'] = htmlspecialchars($_POST['operacion_nombre']);
        $_POST['operacion_descripcion'] = htmlspecialchars($_POST['operacion_descripcion']);
        $_POST['operacion_dependencia'] = filter_var($_POST['operacion_dependencia'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['operacion_direccion'] = htmlspecialchars($_POST['operacion_direccion']);
        $_POST['operacion_ubicacion'] = htmlspecialchars($_POST['operacion_ubicacion']);
        $_POST['operacion_cantidad'] = filter_var($_POST['operacion_cantidad'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['operacion_fecha'] = date('Y-m-d H:i', strtotime($_POST['operacion_fecha']));

        try {
            $operacion = new Operacion($_POST);
            $resultado = $operacion->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Operacion guardada exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar operacion',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
    {
        try {
            $operaciones = Operacion::obtenerOperacionesconQuery();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $operaciones
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar operaciones',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
   
    public static function modificarAPI()
    {
        $_POST['operacion_nombre'] = htmlspecialchars($_POST['operacion_nombre']);
        $_POST['operacion_descripcion'] = htmlspecialchars($_POST['operacion_descripcion']);
        $_POST['operacion_dependencia'] = filter_var($_POST['operacion_dependencia'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['operacion_direccion'] = htmlspecialchars($_POST['operacion_direccion']);
        $_POST['operacion_ubicacion'] = htmlspecialchars($_POST['operacion_ubicacion']);
        $_POST['operacion_cantidad'] = filter_var($_POST['operacion_cantidad'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['operacion_fecha'] = date('Y-m-d H:i', strtotime($_POST['operacion_fecha']));
        $id = filter_var($_POST['operacion_id'], FILTER_SANITIZE_NUMBER_INT);
        try {

            $operacion = Operacion::find($id);
            $operacion->sincronizar($_POST);
            $operacion->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Operacion modificada exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al modificar operacion',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function eliminarAPI()
    {

        $id = filter_var($_POST['operacion_id'], FILTER_SANITIZE_NUMBER_INT);
        try {

            $operacion = Operacion::find($id);
            $operacion->sincronizar([
                 'situacion' => 0
             ]);
            $operacion->actualizar();
            $operacion->eliminar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Operacion eliminada exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminadar operacion',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function mapaAPI()
    {
        $sql = "SELECT * FROM operaciones WHERE operacion_situacion = 1";

        try {
            $envios = Operacion::fetchArray($sql);
            echo json_encode($envios);
            exit;
        } catch (Exception $e) {
            return [];
        }
    }
}

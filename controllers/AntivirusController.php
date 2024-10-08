<?php

namespace Controllers;

use Exception;
use Model\Antivirus;
use MVC\Router;

class AntivirusController
{
    public static function index(Router $router)
    {
        $antivirus = Antivirus::find(2);
        $router->render('antivirus/index', [
            'antivirus' => $antivirus
        ]);
    }

    public static function index3(Router $router)
    {
        $antivirus = Antivirus::find(2);
        $router->render('antivirus/mapa', [
            'antivirus' => $antivirus
        ]);
    }
    
    

    public static function guardarAPI()
    {
        $_POST['antivirus_nombre'] = htmlspecialchars($_POST['antivirus_nombre']);
        $_POST['antivirus_descripcion'] = htmlspecialchars($_POST['antivirus_descripcion']);
        $_POST['antivirus_dependencia'] = filter_var($_POST['antivirus_dependencia'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['antivirus_direccion'] = htmlspecialchars($_POST['antivirus_direccion']);
        $_POST['antivirus_ubicacion'] = htmlspecialchars($_POST['antivirus_ubicacion']);
        $_POST['antivirus_cantidad'] = filter_var($_POST['antivirus_cantidad'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['antivirus_fecha'] = date('Y-m-d H:i', strtotime($_POST['antivirus_fecha']));

        try {
            $antivirus = new Antivirus($_POST);
            $resultado = $antivirus->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Antivirus guardado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar antivirus',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
    {
        try {
            $antivirus = Antivirus::obtenerAntivirusconQuery();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $antivirus
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar antivirus',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
   
    public static function modificarAPI()
    {
        $_POST['antivirus_nombre'] = htmlspecialchars($_POST['antivirus_nombre']);
        $_POST['antivirus_descripcion'] = htmlspecialchars($_POST['antivirus_descripcion']);
        $_POST['antivirus_dependencia'] = filter_var($_POST['antivirus_dependencia'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['antivirus_direccion'] = htmlspecialchars($_POST['antivirus_direccion']);
        $_POST['antivirus_ubicacion'] = htmlspecialchars($_POST['antivirus_ubicacion']);
        $_POST['antivirus_cantidad'] = filter_var($_POST['antivirus_cantidad'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['antivirus_fecha'] = date('Y-m-d H:i', strtotime($_POST['antivirus_fecha']));
        $id = filter_var($_POST['antivirus_id'], FILTER_SANITIZE_NUMBER_INT);
        try {

            $antivirus = Antivirus::find($id);
            $antivirus->sincronizar($_POST);
            $antivirus->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Antivirus modificada exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al modificar antivirus',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function eliminarAPI()
    {

        $id = filter_var($_POST['antivirus_id'], FILTER_SANITIZE_NUMBER_INT);
        try {

            $antivirus = Antivirus::find($id);
            $antivirus->sincronizar([
                 'situacion' => 0
             ]);
            $antivirus->actualizar();
            $antivirus->eliminar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Antivirus eliminada exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminadar antivirus',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function mapaAPI()
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
                operacion_situacion = 1";

        try {
            $envios = Antivirus::fetchArray($sql);
            echo json_encode($envios);
            exit;
        } catch (Exception $e) {
            return [];
        }
    }
}

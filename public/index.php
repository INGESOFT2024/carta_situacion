<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\OperacionController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);

$router->get('/operaciones', [OperacionController::class, 'index']);
$router->get('/API/operacion/buscar', [OperacionController::class, 'buscarAPI']);
$router->post('/API/operacion/guardar', [OperacionController::class, 'guardarAPI']);
$router->post('/API/operacion/modificar', [OperacionController::class, 'modificarAPI']);
$router->post('/API/operacion/eliminar', [OperacionController::class, 'eliminarAPI']);
$router->get('/API/operacion/mapa', [OperacionController::class, 'mapaAPI']);
$router->get('/mapa', [OperacionController::class,'index3']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\OperacionController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);

$router->get('/turnos', [OperacionController::class, 'index']);
$router->get('/API/turno/buscar', [OperacionController::class, 'buscarAPI']);
$router->post('/API/turno/guardar', [OperacionController::class, 'guardarAPI']);
$router->post('/API/turno/modificar', [OperacionController::class, 'modificarAPI']);
$router->post('/API/turno/eliminar', [OperacionController::class, 'eliminarAPI']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

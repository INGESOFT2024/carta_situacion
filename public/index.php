<?php 
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AppController;
use Controllers\OperacionController;
use Controllers\AntivirusController;



$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);

//Operaciones
$router->get('/operaciones', [OperacionController::class, 'index']);
$router->get('/API/operacion/buscar', [OperacionController::class, 'buscarAPI']);
$router->post('/API/operacion/guardar', [OperacionController::class, 'guardarAPI']);
$router->post('/API/operacion/modificar', [OperacionController::class, 'modificarAPI']);
$router->post('/API/operacion/eliminar', [OperacionController::class, 'eliminarAPI']);
$router->get('/API/operacion/mapa', [OperacionController::class, 'mapaAPI']);
$router->get('/mapa', [OperacionController::class,'index3']);

//Anrivirus
$router->get('/antivirus', [AntivirusController::class, 'index']);
$router->get('/API/antivirus/buscar', [AntivirusController::class, 'buscarAPI']);
$router->post('/API/antivirus/guardar', [AntivirusController::class, 'guardarAPI']);
$router->post('/API/antivirus/modificar', [AntivirusController::class, 'modificarAPI']);
$router->post('/API/antivirus/eliminar', [AntivirusController::class, 'eliminarAPI']);
$router->get('/API/antivirus/mapa', [AntivirusController::class, 'mapaAPI']);
$router->get('/mapa', [AntivirusController::class,'index3']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

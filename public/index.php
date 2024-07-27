<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;

$router = new Router();


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'register']);

// Formulario de forget mi password
$router->get('/forget', [AuthController::class, 'forget']);
$router->post('/forget', [AuthController::class, 'forget']);

// Colocar el nuevo password
$router->get('/reset', [AuthController::class, 'reset']);
$router->post('/reset', [AuthController::class, 'reset']);

// Confirmación de Cuenta
$router->get('/message', [AuthController::class, 'message']);
$router->get('/confirm-account', [AuthController::class, 'confirm']);


$router->checkRoutes();
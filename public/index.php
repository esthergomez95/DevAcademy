<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\coursesController;
use Controllers\dashboardController;
use Controllers\registersController;
use Controllers\teachersController;
use MVC\Router;
use Controllers\authController;

$router = new Router();


// Login
$router->get('/login', [authController::class, 'login']);
$router->post('/login', [authController::class, 'login']);
$router->post('/logout', [authController::class, 'logout']);

// Crear Cuenta
$router->get('/register', [authController::class, 'register']);
$router->post('/register', [authController::class, 'register']);

// Formulario de forget mi password
$router->get('/forget', [authController::class, 'forget']);
$router->post('/forget', [authController::class, 'forget']);

// Colocar el nuevo password
$router->get('/reset', [authController::class, 'reset']);
$router->post('/reset', [authController::class, 'reset']);

// Confirmación de Cuenta
$router->get('/message', [authController::class, 'message']);
$router->get('/confirm-account', [authController::class, 'confirm']);

//Administración
$router->get('/admin/dashboard', [dashboardController::class, 'index']);

$router->get('/admin/teacher', [teachersController::class, 'index']);
$router->get('/admin/teacher/create', [teachersController::class, 'create']);
$router->post('/admin/teacher/create', [teachersController::class, 'create']);
$router->post('/admin/teacher/edit', [teachersController::class, 'edit']);
$router->get('/admin/teacher/edit', [teachersController::class, 'edit']);


$router->get('/admin/courses', [coursesController::class, 'index']);
$router->get('/admin/registers', [registersController::class, 'index']);


$router->checkRoutes();
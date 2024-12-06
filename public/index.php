<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\categoriesController;
use Controllers\coursesController;
use Controllers\dashboardController;
use Controllers\finishRegistrationController;
use Controllers\pagesController;
use Controllers\paymentController;
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

//Finish Registration
$router->get('/finish-registration', [finishRegistrationController::class, 'index']);
$router->post('/finish-registration', [finishRegistrationController::class, 'finishRegistration']);
$router->get('/finish-registration', [finishRegistrationController::class, 'finishRegistration']);

$router->get('/payment', [paymentController::class, 'index']);
$router->post('/payment', [paymentController::class, 'processPayment']);
$router->post('/confirmation', [paymentController::class, 'confirmation']);
$router->get('/confirmation', [paymentController::class, 'confirmation']);

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

$router->get('/admin/teachers', [teachersController::class, 'index']);
$router->get('/admin/teachers/create', [teachersController::class, 'create']);
$router->post('/admin/teachers/create', [teachersController::class, 'create']);
$router->post('/admin/teachers/edit', [teachersController::class, 'edit']);
$router->get('/admin/teachers/edit', [teachersController::class, 'edit']);
$router->post('/admin/teachers/delete', [teachersController::class, 'delete']);

$router->get('/admin/courses', [coursesController::class, 'index']);
$router->get('/admin/courses/create', [coursesController::class, 'create']);
$router->post('/admin/courses/create', [coursesController::class, 'create']);
$router->post('/admin/courses/edit', [coursesController::class, 'edit']);
$router->get('/admin/courses/edit', [coursesController::class, 'edit']);
$router->post('/admin/courses/delete', [coursesController::class, 'delete']);

$router->get('/admin/users', [registersController::class, 'index']);
$router->get('/admin/users/create', [registersController::class, 'create']);
$router->post('/admin/users/create', [registersController::class, 'create']);
$router->post('/admin/users/edit', [registersController::class, 'edit']);
$router->get('/admin/users/edit', [registersController::class, 'edit']);
$router->post('/admin/users/delete', [registersController::class, 'delete']);

$router->get('/admin/categories', [categoriesController::class, 'index']);
$router->get('/admin/categories/create', [categoriesController::class, 'create']);
$router->post('/admin/categories/create', [categoriesController::class, 'create']);
$router->post('/admin/categories/edit', [categoriesController::class, 'edit']);
$router->get('/admin/categories/edit', [categoriesController::class, 'edit']);
$router->post('/admin/categories/delete', [categoriesController::class, 'delete']);

$router->get('/admin/registers', [registersController::class, 'index']);

//Area  Publica
$router->get('/', [pagesController::class, 'main']);
$router->get('/about', [pagesController::class, 'about']);
$router->get('/courses', [pagesController::class, 'courses']);
$router->get('/plans', [pagesController::class, 'plans']);
$router->get('/main', [pagesController::class, 'main']);
$router->get('/preview', [pagesController::class, 'preview']);


$router->checkRoutes();
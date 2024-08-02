<?php

namespace Controllers;

use MVC\Router;

class registersController {
    public static function index(Router $router) {
        $router->render('admin/dashboard/index', [
            'title' => 'Usuarios Registrados'
        ]);
    }
}
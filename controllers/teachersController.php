<?php

namespace Controllers;

use MVC\Router;

class teachersController {
    public static function index(Router $router) {
        $router->render('admin/dashboard/index', [
            'title' => 'Profesores'
        ]);
    }
}
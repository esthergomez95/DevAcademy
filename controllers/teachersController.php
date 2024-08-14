<?php

namespace Controllers;

use MVC\Router;

class teachersController {
    public static function index(Router $router) {
        $router->render('admin/teachers/index', [
            'title' => 'Profesores'
        ]);
    }
    public static function create(Router $router) {
        $router->render('admin/teachers/create', [
            'title' => 'Profesores'
        ]);
    }
}
<?php

namespace Controllers;

use MVC\Router;

class coursesController {
    public static function index(Router $router) {
        $router->render('admin/dashboard/index', [
            'title' => 'Cursos'
        ]);
    }
}
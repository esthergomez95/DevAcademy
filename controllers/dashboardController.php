<?php

namespace Controllers;

use MVC\Router;

class dashboardController {
    public static function index(Router $router) {
        $router->render('admin/dashboard/index', [
            'title' => 'Panel de Administración'
        ]);
    }
}
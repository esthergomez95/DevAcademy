<?php

namespace Controllers;

use Model\Teacher;
use MVC\Router;

class teachersController {
    public static function index(Router $router) {
        $router->render('admin/teachers/index', [
            'title' => 'Profesores'
        ]);
    }
    public static function create(Router $router) {
        $alerts = [];
        $teacher = new Teacher;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $teacher->synchronize($_POST);

            $alerts = $teacher->validate();
        }


        $router->render('admin/teachers/create', [
            'title' => 'Profesores',
            'alerts' => $alerts,
            'teacher' => $teacher
        ]);
    }
}
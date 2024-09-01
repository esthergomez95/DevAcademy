<?php

namespace Controllers;

use MVC\Router;

class pagesController{
    public static function index(Router $router){
        $router->render('pages/index', [
            'title' => 'Inicio'
        ]);
    }

    public static function about(Router $router) {
        $router->render('pages/about', [
            'title' => 'Sobre DevAcademy'
        ]);
    }

    public static function courses(Router $router) {
        $router->render('pages/courses', [
            'title' => 'Nuestros cursos'
        ]);
    }

    public static function plans(Router $router) {
        $router->render('pages/plans', [
            'title' => 'Nuestros planes'
        ]);
    }
}


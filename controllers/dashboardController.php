<?php

namespace Controllers;

use MVC\Router;
use Model\Courses;
use Model\Teachers;
use Model\User;
use Model\Categories;

class dashboardController {
    public static function index(Router $router) {
        $coursesCount = Courses::count();
        $teachersCount = Teachers::count();
        $usersCount = User::count();
        $categoriesCount = Categories::count();


        $router->render('admin/dashboard/index', [
            'title' => 'Panel de Administración',
            'coursesCount' => $coursesCount,
            'teachersCount' => $teachersCount,
            'usersCount' => $usersCount,
            'categoriesCount' => $categoriesCount
        ]);

    }
}
<?php

namespace Controllers;

use Model\Categories;
use Model\Courses;
use Model\Teachers;
use MVC\models\Level;
use MVC\Router;

class pagesController{
    public static function main(Router $router){
        $courses = Courses::all();

        $router->render('pages/main', [
            'title' => '¿Que ofrece Dev Academy?',
            'courses' => $courses,
        ]);
    }

    public static function about(Router $router) {
        $router->render('pages/about', [
            'title' => 'Sobre DevAcademy'
        ]);
    }

    public static function courses(Router $router) {
        $category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;
        $level_id = isset($_GET['level_id']) ? intval($_GET['level_id']) : null;
        $teacher_id = isset($_GET['teacher_id']) ? intval($_GET['teacher_id']) : null;

        $categories = Categories::all();
        $teachers = Teachers::all();
        $levels = Level::all();

        if ($category_id) {
            Courses::addFilter('category_id', $category_id);
        }

        if ($level_id) {
            Courses::addFilter('level_id', $level_id);
        }

        if ($teacher_id) {
            Courses::addFilter('teacher_id', $teacher_id);
        }

        $courses = Courses::getFiltered();


        $router->render('pages/courses', [
            'title' => 'Nuestros cursos',
            'courses' => $courses,
            'categories' => $categories,
            'teachers' => $teachers,
            'levels' => $levels,
            'category_id' => $category_id,
            'level_id' => $level_id,
            'teacher_id' => $teacher_id,
        ]);
    }

    public static function plans(Router $router) {
        $router->render('pages/plans', [
            'title' => 'Nuestros planes'
        ]);
    }
}


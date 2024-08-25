<?php

namespace Controllers;

use Model\Courses;
use Model\Categories;
use Model\Teachers;
use MVC\Router;

class coursesController {

    public static function index (Router $router){
        $router ->render('admin/courses/index',[
            'title' => 'Cursos',
        ]);
    }

    public static function create(Router $router)
    {
        $alerts = [];
        $categories = Categories::all();
        $teachers = Teachers::all();

        $courses = new Courses();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $courses->synchronize($_POST);
            $alerts = $courses->validate();

            if (!empty($alerts)) {
                $result = $courses->save();
                if ($result['result']) {
                    header('Location: /admin/courses');
                    exit;
                } else {
                    $alerts['error'][] = 'Error al guardar el curso.';
                }
            }
        }

        $router->render('admin/courses/create', [
            'title' => 'Crear Curso',
            'alerts' => $alerts,
            'categories' => $categories,
            'teachers' => $teachers,
            'courses' => $courses
        ]);
    }
}
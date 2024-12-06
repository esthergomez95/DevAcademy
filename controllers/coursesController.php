<?php
namespace Controllers;

use Model\Courses;
use Model\Categories;
use Model\Teachers;
use MVC\Router;

class coursesController{

    public static function index(Router $router){
        if (!is_admin()) {
            header('Location: /login');
            exit();
        }
        $courses = Courses::all();
        foreach ($courses as $course) {
            $course->teacher = $course->getTeacher();
        }
        $router->render('admin/courses/index', [
            'title' => 'Cursos',
            'courses' => $courses,
        ]);
    }

    public static function create(Router $router){
        if(!is_admin()) {
            header('Location: /login');
            exit();
        }
        $alerts = [];
        $categories = Categories::all();
        $teachers = Teachers::all();

        $courses = new Courses();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $courses->synchronize($_POST);
            $alerts = $courses->validate();

            if (empty($alerts['error'])) {
                $result = $courses->save();
                if ($result['result']) {
                    header('Location: /admin/courses');
                    exit();
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

    public static function edit(Router $router){
        if (!is_admin()) {
            header('Location: /login');
            exit();
        }
        $alerts = [];
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : null;

        if (!$id) {
            header('Location: /admin/courses');
            exit();
        }

        $teachers = Teachers::all();
        $categories = Categories::all();
        $courses = Courses::find($id);
        if (empty($courses)) {
            header('Location: /admin/courses');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $courses->synchronize($_POST);
            $alerts = $courses->validate();
            if (empty($alerts['error'])) {
                $result = $courses->save();
                if ($result === true) {
                    header('Location: /admin/courses');
                    exit();
                } else {
                    $alerts['error'][] = 'Error al actualizar el curso';
                }
            }
        }

        $router->render('admin/courses/edit', [
            'title' => 'Editar Curso',
            'alerts' => $alerts,
            'categories' => $categories,
            'teachers' => $teachers,
            'courses' => $courses
        ]);
    }

    public static function delete()
    {
        if (!is_admin()) {
            header('Location: /login');
            exit();
        }
        $alerts = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
            if (!$id) {
                header('Location: /admin/courses');
                exit();
            }
            $courses = Courses::find($id);
            if (!isset($courses)) {
                header('Location: /admin/courses');
                exit();
            }
            $result = $courses->delete();
            if ($result) {
                header('Location: /admin/courses');
                exit();
            }
        }
    }

}

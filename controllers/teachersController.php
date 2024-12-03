<?php

namespace Controllers;

use Model\Teachers;
use MVC\Router;

class teachersController {
    public static function index(Router $router) {
        $teachers = Teachers::all();
        if(!is_admin()){
            header('Location: /login');

        }
        $router->render('admin/teachers/index', [
            'title' => 'Profesores',
            'teachers' => $teachers
        ]);
    }

    public static function create(Router $router) {
        $alerts = [];
        $teachers = new Teachers;

        if(!is_admin()){
            header('Location: /login');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $teachers->synchronize($_POST);
            $alerts = $teachers->validate();

            if (empty($alerts)) {
                $result = $teachers->save();

                if ($result) {
                    $teachers->save();

                    header('Location: /admin/teachers');
                    exit();
                } else {
                    $alerts[] = 'El profesor no ha podido ser guardado';
                }
            }
        }

        $router->render('admin/teachers/create', [
            'title' => 'Registrar profesor',
            'alerts' => $alerts,
            'teachers' => $teachers
        ]);
    }

    public static function edit(Router $router) {
        if(!is_admin()){
            header('Location: /login');
        }
        $alerts = [];
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : null;

        if (!$id) {
            header('Location: /admin/teachers');
            exit();
        }

        $teachers = Teachers::find($id);
        if (empty($teachers)) {
            header('Location: /admin/teachers');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $teachers->synchronize($_POST);
            $alerts = $teachers->validate();

            if (empty($alerts)) {
                $result = $teachers->save();
                if ($result) {
                    header('Location: /admin/teachers');
                    exit();
                } else {
                    $alerts[] = 'The teacher could not be updated.';
                }
            }
        }

        $router->render('admin/teachers/edit', [
            'title' => 'Modificar profesor',
            'alerts' => $alerts,
            'teachers' => $teachers ?? null
        ]);
    }


    public static function delete(){
        if(!is_admin()){
            header('Location: /login');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $teachers = Teachers::find($id);
            if(!isset($teachers)) {
                header('Location: /admin/teachers');
                exit();
            }
            $result = $teachers->delete();
            if ($result) {
                header('Location: /admin/teachers');
                exit();
            }

        }
    }
}

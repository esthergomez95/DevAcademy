<?php

namespace Controllers;

use Model\Categories;
use Model\Courses;
use MVC\Router;

class categoriesController {
    public static function index(Router $router) {
        if (!is_admin()) {
            header('Location: /login');
            exit();
        }
        $categories = Categories::all();
        $router->render('admin/categories/index', [
            'title' => 'Categorías',
            'categories' => $categories
        ]);
    }

    public static function create(Router $router) {
        if (!is_admin()) {
            header('Location: /login');
            exit();
        }

        $alerts = [];
        $category = new Categories();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category->synchronize($_POST);
            $alerts = $category->validate();

            if (empty($alerts['error'])) {
                $result = $category->save();
                if ($result) {
                    header('Location: /admin/categories');
                    exit();
                } else {
                    $alerts['error'][] = 'La categoría no pudo ser guardada.';
                }
            }
        }

        $router->render('admin/categories/create', [
            'title' => 'Registrar Categoría',
            'alerts' => $alerts,
            'category' => $category
        ]);
    }

    public static function edit(Router $router) {
        if (!is_admin()) {
            header('Location: /login');
            exit();
        }

        $alerts = [];
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : null;

        if (!$id) {
            header('Location: /admin/categories');
            exit();
        }
        $category = Categories::find($id);

        if (!$category) {
            header('Location: /admin/categories');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category->synchronize($_POST);

            $alerts = $category->validate();

            if (empty($alerts['error'])) {
                $result = $category->save();
                if ($result) {
                    header('Location: /admin/categories');
                    exit();
                } else {
                    $alerts['error'][] = 'La categoría no pudo ser actualizada.';
                }
            }
        }

        $router->render('admin/categories/edit', [
            'title' => 'Modificar Categoría',
            'alerts' => $alerts,
            'category' => $category
        ]);
    }

    public static function delete() {
        if (!is_admin()) {
            header('Location: /login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
            if (!$id) {
                header('Location: /admin/categories');
                exit();
            }

            $courses = Courses::addFilter('category_id', $id)->getFiltered();
            foreach ($courses as $course) {
                $course->delete();
            }

            $category = Categories::find($id);
            if ($category) {
                $category->delete();
                header('Location: /admin/categories');
                exit();
            }
        }
    }
}

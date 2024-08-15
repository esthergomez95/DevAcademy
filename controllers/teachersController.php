<?php

namespace Controllers;

use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;
use Model\Teacher;
use MVC\Router;

class teachersController {
    public static function index(Router $router) {
        $teachers = Teacher::all();

        $router->render('admin/teacher/index', [
            'title' => 'Profesores',
            'teacher' => $teachers
        ]);
    }

    public static function create(Router $router) {
        $alerts = [];
        $teacher = new Teacher;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_FILES['image']['tmp_name'])) {
                $directory_images = '../public/img/teacher';

                // Asegurarse de que el directorio exista
                if (!is_dir($directory_images)) {
                    mkdir($directory_images, 0755, true);
                }

                // Procesar la imagen usando ImageManagerStatic
                $manager = new Image(Driver::class);
                $image_png = $manager->read($_FILES['image']['tmp_name'])->cover(800,600);
                $name_image = md5(uniqid(rand(), true));
                $_POST['image'] = $name_image;
            }

            // Sincronizar datos del POST con el modelo
            $teacher->synchronize($_POST);

            // Validar datos
            $alerts = $teacher->validate();

            if (empty($alerts)) {
                if (isset($name_image)) {
                    // Guardar la imagen
                    $image_png->save($directory_images . '/' . $name_image . '.png');
                }

                // Guardar el profesor
                $result = $teacher->save();
                if ($result) {
                    header('Location: /admin/teacher');
                    exit(); // Asegúrate de detener la ejecución después de redirigir
                } else {
                    $alerts[] = 'No se pudo guardar el profesor.';
                }
            }
        }

        $router->render('admin/teacher/create', [
            'title' => 'Registrar profesor',
            'alerts' => $alerts,
            'teacher' => $teacher
        ]);
    }

    public static function edit(Router $router) {
        $alerts = [];
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : null;

        if (!$id) {
            header('Location: /admin/teacher');
            exit(); // Asegúrate de detener la ejecución después de redirigir
        }

        $teacher = Teacher::find($id);
        if (empty($teacher)) {
            header('Location: /admin/teacher');
            exit(); // Asegúrate de detener la ejecución después de redirigir
        }

        $teacher->current_image = $teacher->image;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_FILES['image']['tmp_name'])) {
                $directory_images = '../public/img/teacher/';

                if (!is_dir($directory_images)) {
                    mkdir($directory_images, 0755, true);
                }

                $image_png = Image::make($_FILES['image']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $name_image = md5(uniqid(rand(), true));
                $_POST['image'] = $name_image;
            } else {
                $_POST['image'] = $teacher->current_image;
            }

            $teacher->synchronize($_POST);
            $alerts = $teacher->validate();

            if (empty($alerts)) {
                if (!empty($_FILES['image']['tmp_name'])) {
                    $image_png->save($directory_images . '/' . $name_image . '.png');
                }
                $result = $teacher->save();

                if ($result) {
                    header('Location: /admin/teacher');
                    exit(); // Asegúrate de detener la ejecución después de redirigir
                } else {
                    $alerts[] = 'No se pudo actualizar el profesor.';
                }
            }
        }

        $router->render('admin/teacher/edit', [
            'title' => 'Editar profesor',
            'alerts' => $alerts,
            'teacher' => $teacher ?? null
        ]);
    }
}

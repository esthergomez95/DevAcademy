<?php

namespace Controllers;

use Model\Teacher;
use MVC\Router;

class teachersController {
    public static function index(Router $router) {
        $teachers = Teacher::all();

        $router->render('admin/teachers/index', [
            'title' => 'Profesores',
            'teachers' => $teachers
        ]);
    }

    public static function create(Router $router) {
        $alerts = [];
        $teacher = new Teacher;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_FILES['image']['tmp_name'])) {
                $imageDirectory = '../public/img/teachers';

                if (!is_dir($imageDirectory)) {
                    mkdir($imageDirectory, 0755, true);
                }

                $imageInfo = getimagesize($_FILES['image']['tmp_name']);
                $extension = ($imageInfo['mime'] === 'image/png') ? '.png' : '.jpg';
                $imageName = md5(uniqid(rand(), true)) . $extension;
                $_POST['image'] = $imageName;

                // Save and optimize the image
                self::saveOptimizedImage($imageName, $_FILES['image']['tmp_name'], $extension, 800, 600, $imageDirectory);
            }

            $teacher->synchronize($_POST);
            $alerts = $teacher->validate();

            if (empty($alerts)) {
                $result = $teacher->save();
                if ($result) {
                    header('Location: /admin/teachers');
                    exit();
                } else {
                    $alerts[] = 'El profeson no ha podido ser guardado';
                }
            }
        }

        $router->render('admin/teachers/create', [
            'title' => 'Registrar profesor',
            'alerts' => $alerts,
            'teacher' => $teacher
        ]);
    }

    public static function edit(Router $router) {
        $alerts = [];
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : null;

        if (!$id) {
            header('Location: /admin/teachers');
            exit();
        }

        $teacher = Teacher::find($id);
        if (empty($teacher)) {
            header('Location: /admin/teachers');
            exit();
        }

        $teacher->currentImage = $teacher->image;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_FILES['image']['tmp_name'])) {
                $imageDirectory = '../public/img/teachers';

                if (!is_dir($imageDirectory)) {
                    mkdir($imageDirectory, 0755, true);
                }

                $imageInfo = getimagesize($_FILES['image']['tmp_name']);
                $extension = ($imageInfo['mime'] === 'image/png') ? '.png' : '.jpg';
                $imageName = md5(uniqid(rand(), true)) . $extension;
                $_POST['image'] = $imageName;

                // Save and optimize the image
                self::saveOptimizedImage($imageName, $_FILES['image']['tmp_name'], $extension, 800, 600, $imageDirectory);
            } else {
                $_POST['image'] = $teacher->currentImage;
            }

            $teacher->synchronize($_POST);
            $alerts = $teacher->validate();

            if (empty($alerts)) {
                $result = $teacher->save();
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
            'teacher' => $teacher ?? null
        ]);
    }

    private static function saveOptimizedImage($imageName, $tmpName, $extension, $newWidth, $newHeight, $imageDirectory) {
        move_uploaded_file($tmpName, $imageDirectory . '/' . $imageName);

        if ($extension === '.png') {
            $editedImage = imagecreatefrompng($imageDirectory . '/' . $imageName);
        } else {
            $editedImage = imagecreatefromjpeg($imageDirectory . '/' . $imageName);
        }

        $width = imagesx($editedImage);
        $height = imagesy($editedImage);

        $destination = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($destination, $editedImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        if ($extension === '.png') {
            imagepng($destination, $imageDirectory . '/' . $imageName);
        } else {
            imagejpeg($destination, $imageDirectory . '/' . $imageName);
        }

        imagedestroy($editedImage);
        imagedestroy($destination);
    }

    public static function delete(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $teacher = Teacher::find($id);
            if(!isset($teacher)) {
                header('Location: /admin/teachers');
                exit();
            }
            $result = $teacher->delete();
            if ($result) {
                header('Location: /admin/teachers');
                exit();
            }

        }
    }
}

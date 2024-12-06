<?php

namespace Controllers;

use Model\User;
use MVC\Router;

class registersController {
    public static function index(Router $router) {
        if (!is_admin()) {
            header('Location: /login');
            exit();
        }

        $users = User::all();

        $router->render('admin/users/index', [
            'title' => 'Usuarios',
            'users' => $users
        ]);
    }

    public static function create(Router $router) {
        if (!is_admin()) {
            header('Location: /login');
            exit();
        }

        $alerts = [];
        $user = new User();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'surname' => $_POST['surname'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'password2' => $_POST['password2'] ?? '',
                'admin' => $_POST['admin'] ?? 0
            ];
            $user->synchronize($data);

            $alerts = $user->validateAccount();

            // Generar valores adicionales automáticamente
            $user->hashPassword();
            $user->createToken();
            $user->confirmed = 1;

            if (empty($alerts)) {
                $result = $user->save();
                if ($result) {
                    header('Location: /admin/users');
                    exit();
                } else {
                    $alerts['error'][] = 'Error al guardar el usuario.';
                }
            }
        }

        $router->render('admin/users/create', [
            'title' => 'Registrar Usuario',
            'alerts' => $alerts,
            'user' => $user
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
            header('Location: /admin/users');
            exit();
        }

        $user = User::find($id);
        if (empty($user)) {
            header('Location: /admin/users');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Solo sincroniza campos seguros
            $data = [
                'name' => $_POST['name'] ?? '',
                'surname' => $_POST['surname'] ?? '',
                'email' => $_POST['email'] ?? '',
                'admin' => $_POST['admin'] ?? 0
            ];
            $user->synchronize($data);

            $alerts = $user->validateEmail(); // Solo validamos campos visibles

            if (empty($alerts)) {
                $result = $user->save();
                if ($result) {
                    header('Location: /admin/users');
                    exit();
                } else {
                    $alerts['error'][] = 'Error al actualizar el usuario.';
                }
            }
        }

        $router->render('admin/users/edit', [
            'title' => 'Editar Usuario',
            'alerts' => $alerts,
            'user' => $user
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
                header('Location: /admin/users');
                exit();
            }

            $user = User::find($id);
            if (!$user) {
                header('Location: /admin/users');
                exit();
            }

            // Proteger al administrador principal
            if ($user->admin == 1 && $user->id == 1) {
                $_SESSION['error'] = 'No puedes eliminar al administrador principal.';
                header('Location: /admin/users');
                exit();
            }

            $result = $user->delete();
            if ($result) {
                header('Location: /admin/users');
                exit();
            }
        }
    }
}

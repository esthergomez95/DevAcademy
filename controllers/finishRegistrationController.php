<?php


namespace Controllers;

use Model\User;
use MVC\models\Plans;
use MVC\models\Registers;
use MVC\Router;

ob_start();

class finishRegistrationController{
    public static function index(Router $router) {
        session_start();

        // Verifica si el usuario está logueado
        if (!isset($_SESSION['id'])) {
            header('Location: /login');
            return;
        }

        $user = User::find($_SESSION['id']);

        // Verifica si ya completó el registro
        if ($user->completed_registration) {
            header('Location: /main'); // Redirige a la página principal
            exit;
        }

        $alerts = [];

        // Renderiza la vista para finalizar el registro
        $router->render('register/finish-registration', [
            'title' => 'Elige tu plan para finalizar tu registro',
            'alerts' => $alerts
        ]);
    }

    public static function finishRegistration(Router $router) {
        session_start();

        if (!isset($_SESSION['id'])) {
            header('Location: /login');
            return;
        }

        $user = User::find($_SESSION['id']);

        if ($user->completed_registration) {
            header('Location: /main');
            exit;
        }

        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $plan_id = $_POST['plan'] ?? Plans::P_FREE;

            $user->completed_registration = 1;
            $user->save();

            $register = Registers::where('user_id', $_SESSION['id']);

            if (!$register) {
                $register = new Registers();
                $register->user_id = $_SESSION['id'];
                $register->pay_id = null;
                $register->token = null;
                $register->created = date('Y-m-d H:i:s');
            }

            $register->plan_id = $plan_id;
            $register->save();

            if ($plan_id == Plans::P_PREMIUM) {
                header('Location: /payment');
            } else {
                header('Location: /main');
            }
            exit;
        }

        $router->render('register/finish-registration', [
            'title' => 'Completa tu Registro eligiendo tu Plan',
            'alerts' => $alerts,
            'user' => $user
        ]);
    }
}

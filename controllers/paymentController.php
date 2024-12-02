<?php

namespace Controllers;

use Model\User;
use MVC\models\Registers;
use MVC\Router;

class paymentController
{
    public static function index(Router $router)
    {
        session_start();
        if (!isset($_SESSION['id'])) {
            header('Location: /login');
            exit;
        }

        $user = User::find($_SESSION['id']);
        $register = Registers::where('user_id', $_SESSION['id']);

        $router->render('register/payment', [
            'title' => 'Página de Pago',
            'user' => $user,
            'register' => $register
        ]);
    }

    public static function processPayment(Router $router)
    {
        session_start();

        if (!isset($_SESSION['id'])) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = User::find($_SESSION['id']);
            $register = Registers::where('user_id', $_SESSION['id']);

            $register->plan_id = '2';
            $register->pay_id = '123456';
            $register->completed_registration = 1;
            $register->token = bin2hex(random_bytes(16));

            $register->save();

            header('Location: /confirmation');
            exit;
        }

        header('Location: /payment');
        exit;
    }

    public static function confirmation(Router $router)
    {
        session_start();
        if (!isset($_SESSION['id'])) {
            header('Location: /login');
            exit;
        }
        $user = User::find($_SESSION['id']);
        $register = Registers::where('user_id', $_SESSION['id']);

        $router->render('/register/payment/confirmation', [
            'title' => 'Confirmación de Pago',
            'user' => $user,
            'register' => $register
        ]);
    }
}

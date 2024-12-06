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
            $cardNumber = trim($_POST['card_number'] ?? '');
            $cardName = trim($_POST['card_name'] ?? '');
            $expiryDate = trim($_POST['expiry_date'] ?? '');
            $cvv = trim($_POST['cvv'] ?? '');

            if (
                empty($cardNumber) || !preg_match('/^\d{4}\s\d{4}\s\d{4}\s\d{4}$/', $cardNumber) ||
                empty($cardName) || strlen($cardName) < 3 ||
                empty($expiryDate) || !preg_match('/^\d{2}\/\d{2}$/', $expiryDate) ||
                empty($cvv) || !preg_match('/^\d{3}$/', $cvv)
            ) {
                $_SESSION['payment_error'] = 'Datos de la tarjeta inválidos.';
                header('Location: /payment');
                exit;
            }

            $register = Registers::where('user_id', $_SESSION['id']);

            if (!$register) {
                $register = new Registers();
                $register->user_id = $_SESSION['id'];
                $register->created = date('Y-m-d H:i:s');
            }

            $register->last4 = substr($cardNumber, -4); // Últimos 4 dígitos de la tarjeta
            $register->card_name = $cardName;
            $register->expiry_date = $expiryDate;

            $register->plan_id = '2'; // Este valor dependerá de tu lógica
            $register->pay_id = bin2hex(random_bytes(8)); // ID de pago generado
            $register->token = bin2hex(random_bytes(16)); // Token de seguridad
            $register->completed_registration = 1;

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

        $user = User::find($_SESSION['id']);
        $register = Registers::where('user_id', $_SESSION['id']);

        $router->render('register/confirmation', [
            'title' => 'Confirmación de Pago',
            'user' => $user,
            'register' => $register
        ]);
    }
}

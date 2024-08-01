<?php

namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class AuthController {
    public static function login(Router $router) {

        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            $user = new User($_POST);

            $alerts = $user->validateLogin();
            
            if(empty($alerts)) {
                // Verificar quel el user exista
                $user = User::where('email', $user->email);
                if(!$user || !$user->confirmed ) {
                    User::setAlert('error', 'The User Does Not Exist or is not there 
                    confirmed');
                } else {
                    // El User existe
                    if( password_verify($_POST['password'], $user->password) ) {
                        
                        // Iniciar la sesión
                        session_start();    
                        $_SESSION['id'] = $user->id;
                        $_SESSION['name'] = $user->name;
                        $_SESSION['surname'] = $user->surname;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['admin'] = $user->admin ?? null;

                    } else {
                        User::setAlert('error', 'Incorrect password');
                    }
                }
            }
        }

        $alerts = User::getAlert();
        
        // Render a la vista 
        $router->render('auth/login', [
            'title' => 'Iniciar Sesión',
            'alerts' => $alerts
        ]);
    }

    public static function logout() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $_SESSION = [];
            header('Location: /');
        }
       
    }

    public static function register(Router $router) {
        $alerts = [];
        $user = new User;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user->synchronize($_POST);
            
            $alerts = $user->validateAccount();

            if(empty($alerts)) {
                $userExist = User::where('email', $user->email);

                if($userExist) {
                    User::setAlert('error', 'El User ya esta registrado');
                    $alerts = User::getAlert();
                } else {
                    // Hashear el password
                    $user->hashPassword();

                    // Eliminar password2
                    unset($user->password2);

                    // Generar el Token
                    $user->createToken();

                    // Crear un nuevo user
                    $result =  $user->save();

                    // Enviar email
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendConfirmation();
                    

                    if($result) {
                        header('Location: /message');
                    }
                }
            }
        }

        // Render a la vista
        $router->render('auth/register', [
            'title' => 'Crea tu cuenta en DevWebcamp',
            'user' => $user,
            'alerts' => $alerts
        ]);
    }

    public static function forget(Router $router) {
        $alerts = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);
            $alerts = $user->validateEmail();

            if(empty($alerts)) {
                // Buscar el user
                $user = User::where('email', $user->email);

                if($user && $user->confirmed) {

                    // Generar un nuevo token
                    $user->createToken();
                    unset($user->password2);

                    // Actualizar el user
                    $user->save();

                    // Enviar el email
                    $email = new Email( $user->email, $user->name, $user->token );
                    $email->sendInstructions();


                    // Imprimir la alerta
                    // User::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');

                    $alerts['exito'][] = 'Hemos enviado las instrucciones a tu email';
                } else {
                 
                    // User::setAlerta('error', 'El User no existe o no esta confirmed');

                    $alerts['error'][] = 'El User no existe o no esta confirmed';
                }
            }
        }

        // Muestra la vista
        $router->render('auth/forget', [
            'title' => 'Olvide mi Password',
            'alerts' => $alerts
        ]);
    }

    public static function reset(Router $router) {

        $token = s($_GET['token']);

        $valid_token = true;

        if(!$token) header('Location: /');

        // Identificar el user con este token
        $user = User::where('token', $token);

        if(empty($user)) {
            User::setAlert('error', 'Token No Válido, intenta de nuevo');
            $valid_token = false;
        }


        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Añadir el nuevo password
            $user->synchronize($_POST);

            // Validar el password
            $alerts = $user->validatePassword();

            if(empty($alerts)) {
                // Hashear el nuevo password
                $user->hashPassword();

                // Eliminar el Token
                $user->token = null;

                // Guardar el user en la BD
                $result = $user->save();

                // Redireccionar
                if($result) {
                    header('Location: /');
                }
            }
        }

        $alerts = User::getAlert();
        
        // Muestra la vista
        $router->render('auth/reset', [
            'title' => 'Reestablecer Password',
            'alerts' => $alerts,
            'valid_token' => $valid_token
        ]);
    }

    public static function message(Router $router) {

        $router->render('auth/message', [
            'title' => 'Cuenta Creada Exitosamente'
        ]);
    }

    public static function confirm(Router $router) {
        
        $token = s($_GET['token']);

        if(!$token) header('Location: /');
        $user = User::where('token', $token);

        if(empty($user)) {
            User::setAlert('error', 'Token no válido, la cuenta no ha sido confirmada');
        } else {

            // Confirm account
            $user->confirmed = 1;
            $user->token = '';
            unset($user->password2);

            $user->save();

            User::setAlert('success', 'Su cuenta ha sido confirmada con exito');
        }

     

        $router->render('auth/confirm', [
            'title' => 'Confirma tu cuenta DevWebcamp',
            'alerts' => User::getAlert()
        ]);
    }

  
}
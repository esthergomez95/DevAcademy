<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $name;
    public $token;
    
    public function __construct($email, $name, $token)
    {
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }

    public function sendConfirmation() {

         // create a new object
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['EMAIL_HOST'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['EMAIL_PORT'];
         $mail->Username = $_ENV['EMAIL_USER'];
         $mail->Password = $_ENV['EMAIL_PASS'];
     
         $mail->setFrom('cuentas@devwebcamp.com');
         $mail->addAddress($this->email, $this->name);
         $mail->Subject = 'Confirma tu Cuenta';

         // Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';

        $content = '<!DOCTYPE html>';
        $content .= '<html lang="es">';
        $content .= '<head>';
        $content .= '<meta charset="UTF-8">';
        $content .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $content .= '<title>Confirmación de Cuenta</title>';
        $content .= '<style>';
        $content .= 'body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; }';
        $content .= 'p { margin: 0 0 10px; }';
        $content .= 'a { color: #007bff; text-decoration: none; }';
        $content .= 'a:hover { text-decoration: underline; }';
        $content .= '</style>';
        $content .= '</head>';
        $content .= '<body>';
        $content .= '<p><strong>Hola ' . s($this->name, ENT_QUOTES, 'UTF-8') . ',</strong></p>';
        $content .= '<p>Has registrado correctamente tu cuenta en DevAcademy. Sin embargo, es necesario confirmar tu cuenta para completar el proceso de registro.</p>';
        $content .= '<p>Para confirmar tu cuenta, presiona el siguiente enlace:</p>';
        $content .= '<p><a href="' . s($_ENV['HOST'], ENT_QUOTES, 'UTF-8') . '/confirm-account?token=' . htmlspecialchars($this->token, ENT_QUOTES, 'UTF-8') . '">Confirmar Cuenta</a></p>';
        $content .= '<p>Si no creaste esta cuenta, ignora este mensaje.</p>';
        $content .= '</body>';
        $content .= '</html>';
         $mail->Body = $content;

         //Enviar el mail
         $mail->send();

    }

    public function sendInstructions() {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@devwebcamp.com');
        $mail->addAddress($this->email, $this->name);
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $content = '<!DOCTYPE html>';
        $content .= '<html lang="es">';
        $content .= '<head>';
        $content .= '<meta charset="UTF-8">';
        $content .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $content .= '<title>Reestablecimiento de Contraseña</title>';
        $content .= '<style>';
        $content .= 'body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; }';
        $content .= 'p { margin: 0 0 10px; }';
        $content .= 'a { color: #007bff; text-decoration: none; }';
        $content .= 'a:hover { text-decoration: underline; }';
        $content .= '</style>';
        $content .= '</head>';
        $content .= '<body>';
        $content .= '<p><strong>Hola ' . s($this->name, ENT_QUOTES, 'UTF-8') . ',</strong></p>';
        $content .= '<p>Recibimos una solicitud para cambiar tu contraseña. Por favor, accede al siguiente enlace para completar el proceso:</p>';
        $content .= '<p><a href="' . s($_ENV['HOST'], ENT_QUOTES, 'UTF-8') . '/reset?token=' . s($this->token, ENT_QUOTES, 'UTF-8') . '">Cambiar Contraseña</a></p>';
        $content .= '<p>Si no hiciste esta solicitud, simplemente ignora este mensaje.</p>';
        $content .= '</body>';
        $content .= '</html>';
        $mail->Body = $content;

        //Enviar el mail
        $mail->send();
    }
}
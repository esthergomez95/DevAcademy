<?php

namespace Model;

class User extends ActiveRecord {
    protected static $table = 'users';
    protected static $columnsDB = ['id', 'created', 'name', 'surname', 'email', 'password', 'confirmed', 'token', 'admin'];

    public $id;
    public $created;
    public $name;
    public $surname;
    public $email;
    public $password;
    public $password2;
    public $confirmed;
    public $token;
    public $admin;

    public $current_password;
    public $new_password;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->created = $args['created'] ?? date('Y/m/d H:i:s');
        $this->name = $args['name'] ?? '';
        $this->surname = $args['surname'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->confirmed = $args['confirmed'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->admin = $args['admin'] ?? '';
    }

    // Validar el Login de Usuarios
    public function validateLogin() {
        if(!$this->email) {
            self::$alerts['error'][] = 'El Email del Usuario es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'Email no válido';
        }
        if(!$this->password) {
            self::$alerts['error'][] = 'El Password no puede ir vacio';
        }
        return self::$alerts;

    }

    // Validación para cuentas nuevas
    public function validateAccount() {
        if (empty($this->name)) {
            self::$alerts['error'][] = 'El nombre es obligatorio.';
        }
        if (empty($this->surname)) {
            self::$alerts['error'][] = 'Los apellidos son obligatorios.';
        }
        if (empty($this->email)) {
            self::$alerts['error'][] = 'El correo electrónico es obligatorio.';
        }
        if (empty($this->password)) {
            self::$alerts['error'][] = 'La contraseña no puede estar vacía.';
        }
        if (strlen($this->password) < 6) {
            self::$alerts['error'][] = 'La contraseña debe tener al menos 6 caracteres.';
        }
        if ($this->password !== $this->password2) {
            self::$alerts['error'][] = 'Las contraseñas no coinciden.';
        }

        return self::$alerts;
    }

    // Valida un email
    public function validateEmail() {
        if(!$this->email) {
            self::$alerts['error'][] = 'El Email es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'Email no válido';
        }
        return self::$alerts;
    }

    // Valida el Password 
    public function validatePassword() {
        if(!$this->password) {
            self::$alerts['error'][] = 'El Password no puede ir vacio';
        }
        if(strlen($this->password) < 6) {
            self::$alerts['error'][] = 'El password debe contener al menos 6 caracteres';
        }
        return self::$alerts;
    }

    public function newPassword() : array {
        if(!$this->current_password) {
            self::$alerts['error'][] = 'El Password Actual no puede ir vacio';
        }
        if(!$this->new_password) {
            self::$alerts['error'][] = 'El Password Nuevo no puede ir vacio';
        }
        if(strlen($this->new_password) < 6) {
            self::$alerts['error'][] = 'El Password debe contener al menos 6 caracteres';
        }
        return self::$alerts;
    }

    // Comprobar el password
    public function checkPassword() : bool {
        return password_verify($this->current_password, $this->password );
    }

    // Hashea el password
    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Generar un Token
    public function createToken() : void {
        $this->token = uniqid();
    }
}
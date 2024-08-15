<?php

namespace Model;

class Teacher extends ActiveRecord{

    protected static $table = 'teacher';
    protected static $columnsDB = ['id', 'created', 'name', 'surname', 'city', 'country', 'image', 'tags'];
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->created = $args['created'] ?? date('Y/m/d H:i:s');
        $this->name = $args['name'] ?? '';
        $this->surname = $args['surname'] ?? '';
        $this->city = $args['city'] ?? '';
        $this->country = $args['country'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->tags = $args['tags'] ?? '';
    }

    public function validate() {
        if (!$this->name) {
            self::$alerts['error'][] = 'El campo Nombre es obligatorio';
        }
        if (!$this->surname) {
            self::$alerts['error'][] = 'El campo Apellido es obligatorio';
        }
        if (!$this->city) {
            self::$alerts['error'][] = 'El campo Ciudad es obligatorio';
        }
        if (!$this->country) {
            self::$alerts['error'][] = 'El campo País es obligatorio';
        }
        if (!$this->image) {
            self::$alerts['error'][] = 'El campo Imagen es obligatorio';
        }
        if (!$this->tags) {
            self::$alerts['error'][] = 'El campo Tags es obligatorio';
        }

        return self::$alerts;
    }

}

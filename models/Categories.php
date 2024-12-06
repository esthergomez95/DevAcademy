<?php

namespace Model;

class Categories extends ActiveRecord {

    protected static $table = 'courses_categories';
    protected static $columnsDB = ['id', 'name'];

    public $id;
    public $name;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }

    public function validate() {
        self::$alerts = ['error' => []];

        if (!$this->name) {
            self::$alerts['error'][] = 'El Nombre es obligatorio';
        }
        return self::$alerts;
    }
}

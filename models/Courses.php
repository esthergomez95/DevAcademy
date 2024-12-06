<?php

namespace Model;

class Courses extends ActiveRecord
{

    protected static $table = 'courses';

    protected static $columnsDB = [
        'id',
        'name',
        'description',
        'requirements',
        'outcomes',
        'price',
        'category_id',
        'teacher_id'
    ];

    public $id;
    public $name;
    public $description;
    public $requirements;
    public $outcomes;
    public $price;
    public $category_id;
    public $teacher_id;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->requirements = $args['requirements'] ?? '';
        $this->outcomes = $args['outcomes'] ?? '';
        $this->price = $args['price'] ?? 0.00;
        $this->category_id = $args['category_id'] ?? null;
        $this->teacher_id = $args['teacher_id'] ?? null;
    }
    public function validate() {
        self::$alerts = ['error' => []];

        if (!$this->name) {
            self::$alerts['error'][] = 'El Nombre es obligatorio';
        }
        if (!$this->description) {
            self::$alerts['error'][] = 'La Descripción es obligatoria';
        }
        if (!$this->outcomes) {
            self::$alerts['error'][] = 'Los Requisitos son obligatorios';
        }
        if (!$this->requirements) {
            self::$alerts['error'][] = 'Los Resultados de Aprendizaje son obligatorios';
        }
        if (!is_numeric($this->price) || $this->price < 0) {
            self::$alerts['error'][] = 'El Precio no puede ser un número negativo';
        }
        if (!$this->category_id || !filter_var($this->category_id, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Selecciona una Categoría válida';
        }
        if (!$this->teacher_id || !filter_var($this->teacher_id, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Selecciona un Profesor válido';
        }
        return self::$alerts;
    }

    public function getTeacher() {
        if ($this->teacher_id) {
            return Teachers::find($this->teacher_id);
        }
        return null;
    }
}
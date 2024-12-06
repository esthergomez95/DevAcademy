<?php
namespace Model;
class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $table = '';
    protected static $columnsDB = [];

    protected static $filters = [];

    // Alertas y Mensajes
    protected static $alerts = [];

    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    // Setear un type de Alerta
    public static function setAlert($type, $message) {
        static::$alerts[$type][] = $message;
    }

    // Obtener las alertas
    public static function getAlert() {
        return static::$alerts;
    }

    // Validación que se hereda en modelos
    public function validate() {
        static::$alerts = [];
        return static::$alerts;
    }

    // Consulta SQL para create un object en Memoria (Active Record)
    public static function querySQL($query) {
        // Consultar la base de datos
        $result = self::$db->query($query);

        // Iterar los results
        $array = [];
        while($record = $result->fetch_assoc()) {
            $array[] = static::createObject($record);
        }

        // liberar la memoria
        $result->free();

        // retornar los results
        return $array;
    }

    // Crea el object en memoria que es igual al de la BD
    protected static function createObject($record) {
        $object = new static;

        foreach($record as $key => $value ) {
            if(property_exists( $object, $key  )) {
                $object->$key = $value;
            }
        }
        return $object;
    }

    // Identificar y unir los attributte de la BD
    public function attributte() {
        $attributte = [];
        foreach(static::$columnsDB as $column) {
            if($column === 'id') continue;
            $attributte[$column] = $this->$column;
        }
        return $attributte;
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizeAttribute() {
        $attributte = $this->attributte();
        $sanitized = [];
        foreach($attributte as $key => $value ) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    // Sincroniza BD con Objetos en memoria
    public function synchronize($args = []) {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key)) {
                // Limpia los espacios en blanco
                $cleanValue = trim($value);

                if ($key === 'email') {
                    $cleanValue = strtolower($cleanValue);
                }

                $this->$key = $cleanValue;
            }
        }
    }

    // Registros - CRUD
    public function save() {
        $result = '';
        if(!is_null($this->id)) {
            // actualizar

            $result = $this->update();
        } else {
            // Creando un nuevo record
            $result = $this->create();
        }
        return $result;
    }

    // Obtener todos los Registros
    public static function all($order = 'DESC') {
        $query = "SELECT * FROM " . static::$table . " ORDER BY id {$order}";
        $result = self::querySQL($query);
        return $result;
    }

    // Busca un record por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$table  ." WHERE id = ${id}";
        $result = self::querySQL($query);
        return array_shift( $result ) ;
    }

    // Obtener Registros con cierta cantidad
    public static function get($limit) {
        $query = "SELECT * FROM " . static::$table . " LIMIT ${limit} ORDER BY id DESC" ;
        $result = self::querySQL($query);
        return array_shift( $result ) ;
    }

    // Busqueda Where con Columna 
    public static function where($column, $value) {
        $query = "SELECT * FROM " . static::$table . " WHERE ${column} = '${value}'";
        $result = self::querySQL($query);
        return  array_shift($result);
    }

    // crea un nuevo record
    public function create()
    {
        // Sanitizar los datos
        $attributte = $this->sanitizeAttribute();

        // Insertar en la base de datos
        $query = "INSERT INTO " . static::$table . " (";
        $query .= join(', ', array_keys($attributte));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributte));
        $query .= "')";

       //debuguear($query); // Descomentar si no te funciona algo

        // Resultado de la consulta
        $result = self::$db->query($query);
        if ($result) {
            $this->id = self::$db->insert_id;
            return [
                'result' => $result,
                'id' => $this->id
            ];
        }
    }


    // Actualizar el record
    public function update() {
        // Sanitizar los datos
        $attributte = $this->sanitizeAttribute();

        // Iterar para ir agregando cada campo de la BD
        $values = [];
        foreach($attributte as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . static::$table ." SET ";
        $query .=  join(', ', $values );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 "; 

        // Actualizar BD
        $result = self::$db->query($query);
        return $result;
    }

    // Eliminar un Registro por su ID
    public function delete() {
        $query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $result = self::$db->query($query);
        return $result;
    }

    public static function addFilter($column, $value) {
        static::$filters[] = "${column} = '" . self::$db->escape_string($value) . "'";
        return new static;
    }

    protected static function buildQuery() {
        $query = "SELECT * FROM " . static::$table;
        if (!empty(static::$filters)) {
            $query .= " WHERE " . join(' AND ', static::$filters);
        }
        return $query;
    }

    public static function getFiltered() {
        $query = static::buildQuery();
        $result = self::querySQL($query);
        static::$filters = [];
        return $result;
    }

    public static function count() {
        $query = "SELECT COUNT(*) AS count FROM " . static::$table;
        $result = self::$db->query($query);
        $data = $result->fetch_assoc();
        return $data['count'] ?? 0;
    }
}
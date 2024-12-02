<?php

namespace MVC\models;

use Model\ActiveRecord;

class Level extends ActiveRecord {

    protected static $table = 'courses_level';
    protected static $columnsDB = ['id', 'name'];

    public $id;
    public $name;

}
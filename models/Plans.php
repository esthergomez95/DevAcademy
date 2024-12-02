<?php

namespace MVC\models;

use Model\ActiveRecord;

class Plans extends ActiveRecord{

    const P_FREE = 1;
    const P_PREMIUM = 2;

    protected static $table = 'plans';
    protected static $columnsDB = ['id', 'name'];

    public $id;
    public $name;
}
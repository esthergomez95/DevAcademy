<?php

namespace Model;

class Categories extends ActiveRecord {

    protected static $table = 'courses_categories';
    protected static $columnsDB = ['id', 'name'];

    public $id;
    public $name;

}
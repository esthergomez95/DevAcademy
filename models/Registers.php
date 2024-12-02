<?php

namespace MVC\models;

use Model\ActiveRecord;

class Registers extends ActiveRecord {
    protected static $table = 'registers';
    protected static $columnsDB = ['id', 'user_id', 'plan_id', 'pay_id', 'token', 'completed_registration' , 'created'];

    public $id;
    public $user_id;
    public $plan_id;
    public $pay_id;
    public $token;

    public $completed_registration;
    public $created;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->user_id = $args['user_id'] ?? '';
        $this->plan_id = $args['plan_id'] ?? '';
        $this->pay_id = $args['pay_id'] ?? null;
        $this->completed_registration = $args['completed_registration'] ?? 0;
        $this->token = $args['token'] ?? null;
        $this->created = $args['created'] ?? date('Y-m-d H:i:s');
    }
}

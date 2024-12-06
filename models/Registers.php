<?php

namespace MVC\models;

use Model\ActiveRecord;

class Registers extends ActiveRecord {
    protected static $table = 'registers';
    protected static $columnsDB = [
        'id',
        'user_id',
        'plan_id',
        'pay_id',
        'token',
        'completed_registration',
        'last4',
        'card_name',
        'expiry_date',
        'created'
    ];

    public $id;
    public $user_id;
    public $plan_id;
    public $pay_id;
    public $token;
    public $completed_registration;
    public $last4;
    public $card_name;
    public $expiry_date;
    public $created;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->user_id = $args['user_id'] ?? '';
        $this->plan_id = $args['plan_id'] ?? '';
        $this->pay_id = $args['pay_id'] ?? null;
        $this->token = $args['token'] ?? null;
        $this->completed_registration = $args['completed_registration'] ?? 0;
        $this->last4 = $args['last4'] ?? null;
        $this->card_name = $args['card_name'] ?? '';
        $this->expiry_date = $args['expiry_date'] ?? '';
        $this->created = $args['created'] ?? date('Y-m-d H:i:s');
    }
}

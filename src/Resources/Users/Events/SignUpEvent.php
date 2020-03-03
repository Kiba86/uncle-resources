<?php

namespace App\Http\Resources\Users\Events;

use Illuminate\Auth\Events\Registered;

class SignUpEvent extends Registered{

    public $fields;

    public function __construct($user, $fields) {
        parent::__construct($user);
        $this->fields = $fields;
    }

}
<?php

namespace App\Http\Resources\Users\Events;

use Illuminate\Auth\Events\Registered;

class SocialSignUpEvent extends Registered{

    public $driver;
    public $socialUser;

    public function __construct($user, $driver, $socialUser) {
        parent::__construct($user);
        $this->driver = $driver;
        $this->socialUser = $socialUser;
    }

}
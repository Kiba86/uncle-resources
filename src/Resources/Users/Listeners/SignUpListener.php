<?php

namespace App\Http\Resources\Users\Listeners;

use App\Http\Resources\Users\Events\SignUpEvent;
use App\Http\Resources\Users\Notifications\SignUpNotification;

class SignUpListener {

    public function __construct() {
    }

    public function handle(SignUpEvent $event) {
        $user = $event->user;
        $fields = $event->fields;
        $user->assignRole($fields->role);
        $user->save();

        $user->notify( new SignUpNotification($user));
        //MailHelper::send($user->email, new Welcome());
    }

}

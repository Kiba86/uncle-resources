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

        $userResource = App::make('UsersResource');
        $userProfileRepository = $userResource->getRepository('UserProfile');
        $userProfile = $userProfileRepository->findByField('user_id', $user->id)->first();
        if (!$userProfile) {
            $user->profile()->create(['user_id' => $user->id]);
        }

        $user->notify( new SignUpNotification($user));

    }

}

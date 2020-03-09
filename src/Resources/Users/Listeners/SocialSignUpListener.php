<?php

namespace App\Http\Resources\Users\Listeners;
 
use App\Http\Resources\Users\Events\SocialSignUpEvent;
use App\Http\Resources\Users\Notifications\SignUpNotification;
use App;

class SocialSignUpListener {

    public function __construct() {
    }

    public function handle(SocialSignUpEvent $event) {
        $user = $event->user;
        $socialUser = $event->socialUser;
        $driver = $event->driver;
        $user->assignRole('user');
        $userResource = App::make('UsersResource');
        $userProfileRepository = $userResource->getRepository('UserProfile');
        $userProfile = $userProfileRepository->findByField('user_id', $user->id)->first();
        if (!$userProfile) {
            $user->profile()->create([
                'firstName' => $socialUser->name
            ]);
        }

        $user->notify( new SignUpNotification());
    }

}
<?php

namespace App\Http\Resources\Users\Services;

use App\Http\Resources\Users\Exceptions\SignUpException;
use App\Http\Resources\Users\Events\SignUpEvent;
use App\Http\Resources\Users\Events\SocialSignUpEvent;
use Illuminate\Support\Carbon;
use App;
use Auth;

class AuthService {

    protected $userResource = null;
    protected $userRepository = null;

    public function __construct() {
        $this->userResource = App::make('UsersResource');
        $this->userRepository = $this->userResource->getRepository('User');
    }

    public function login($email, $password, $expireMinute = null) {
        $auth = Auth::guard();
        if(isset($expireMinute)) {
            $auth = $auth->setTTL($expireMinute);
        }
        return $auth->attempt(['email' => $email, 'password' => $password]);
    }

    public function logout() {
        Auth::guard()->logout();
    }

    public function refresh() {
        return Auth::guard()->refresh();
    }

    public function signup($fields) {
        $user = $this->userRepository->findByField('email', $fields->email)->first();
        if ($user) {
            throw new SignUpException();
        } else {
            $user = $this->userRepository->create((array) $fields);
            event(new SignUpEvent($user, $fields));
        }
        return $user;
    }

    public function socialLogin($socialUser, $driver) {
        $userResource = App::make('UsersResource');
        $userRepository = $userResource->getRepository('User');
        $user = $userRepository->findByField('email', $socialUser->email)->first();
        if (!$user) {
            $user = $userRepository->create([
                'email' => $socialUser->email,
                'password' => 'social'
            ]);
            event(new SocialSignUpEvent($user, $driver, $socialUser));
        }
        $userSocialAccountRepository = $userResource->getRepository('UserSocialAccount');
        $userSocialAccount = $userSocialAccountRepository->findWhere(['user_id' => $user->id, 'provider' => $driver])->first();
        if (!$userSocialAccount) {
            $userSocialAccount = $user->social_accounts()->create([
                'email' => $socialUser->email,
                'provider' => $driver
            ]);    
        }
        return $user;
    }

}
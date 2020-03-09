<?php

namespace App\Http\Resources\Users\Traits;

use Tymon\JWTAuth\JWTAuth;
use Laravel\Socialite\Facades\Socialite;
use App;

trait SocialLogin {

    /**
     * Redirect to social provider.
     *
     */

    public function socialRedirectToProvider($driver) {
        if ($driver == 'facebook') {
            return Socialite::driver($driver)->fields([
                'first_name', 'last_name', 'email', 'gender', 'birthday'
            ])->scopes([
                'email', 'user_birthday'
            ])->stateless()->redirect();
        } else if ($driver == 'google'){
            return Socialite::driver($driver)->stateless()->redirect();
        }
        else if ($driver == 'twitter'){
            return Socialite::driver($driver)->stateless()->redirect();
        }

    }

    /**
     * Social login
     *
     * @response {
     *  "token": "[token]",
     *  "expires_in": "3600",
     *  "user": {"transformer":"App\\Http\\Resources\\Users\\Presenters\\UserTransformer", "transformerModel":"App\\Http\\Resources\\Users\\Models\\User", "query":{"email":"user@mail.com"}}
     *  }
     */

    public function socialHandleProviderCallback(JWTAuth $JWTAuth, $driver) {
        $socialUser = Socialite::driver($driver)->stateless()->user();
        $userResource = App::make('UsersResource');
        $authService = $userResource->getService('Auth');
        $userRepository = $userResource->getRepository('User');
        $user = $authService->socialLogin($socialUser, $driver);
        $token = $JWTAuth->fromUser($user);
        $user = $userRepository->findWithPresenter($user->id, 'User');
        return $this->validSuccessJsonResponse('Success', [
            'token' => $token,
            'expires_in' => $this->getTokenExpireTime(),
            'user' => $user
        ]);
    }

}
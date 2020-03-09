<?php

namespace App\Http\Resources\Users\Traits;

use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Password;
use App\Http\Resources\Users\Requests\RecoveryPasswordRequest;
use App\Http\Resources\Users\Requests\ResetPasswordRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App;

trait RecoveryPassword {

    private function getPasswordBroker() {
        return Password::broker();
    }

    private function credentials(ResetPasswordRequest $request) {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Recovery the password.
     *
     */
    public function recovery(RecoveryPasswordRequest $request)
    {
        $userResource = App::make('UsersResource');
        $userRepository = $userResource->getRepository('User');
        $user = $userRepository->findByField('email', $request->email)->first();
        if ($user) {
            $broker = $this->getPasswordBroker();
            $sendingResponse = $broker->sendResetLink($request->only('email'));
            if($sendingResponse !== Password::RESET_LINK_SENT) {
                throw new HttpException(500);
            }
            return $this->validSuccessJsonResponse('Success');
        }
    }

    /**
     * Reset the password.
     *
     */
    public function resetPassword(ResetPasswordRequest $request, JWTAuth $JWTAuth) {
        $response = $this->getPasswordBroker()->reset(
            $this->credentials($request), function ($user, $password) {
            $user->password = $password;
            $user->save();
        }
        );
        if($response == Password::INVALID_USER) {
            throw new HttpException(500, 'Invalid user');
        }
        if($response == Password::INVALID_TOKEN) {
            throw new HttpException(500, 'Invalid token');
        }
        if($response !== Password::PASSWORD_RESET) {
            throw new HttpException(500);
        }
        $userResource = App::make('UsersResource');
        $userRepository = $userResource->getRepository('User');
        $user = $userRepository->findByField('email', $request->email)->first();
        return $this->validSuccessJsonResponse('Success', [
            'token' => $JWTAuth->fromUser($user)
        ]);
    }

}
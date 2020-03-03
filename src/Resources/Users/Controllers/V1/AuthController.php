<?php

namespace App\Http\Resources\Users\Controllers\V1;

use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\Requests\LoginRequest;
use App\Http\Resources\Users\Requests\SignUpRequest;
use App\Http\Resources\Users\Requests\RecoveryPasswordRequest;
use App\Http\Resources\Users\Requests\ResetPasswordRequest;
use App\Http\Resources\Users\Requests\ChangePasswordRequest;
use App\Http\Resources\Users\Requests\ChangeEmailRequest;

use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Resources\Users\Exceptions\SignUpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

use App\Http\Resources\Users\Models\UserSocialAccount;
use App\Http\Resources\Users\Models\UserProfile;

use UncleProject\UncleLaravel\Traits\ControllerHelper;

use Auth;
use App;
use Hash;
use Exception;

/**
 * @group User
 *
 * APIs for managing user
 */

class AuthController extends Controller {

    use ControllerHelper;

    private $userResource = null;
    private $userService = null;
    private $userRepository = null;

    public function __construct() {
    }

    private function getTokenExpireTime($minuteToExpire = 60) {
        return Auth::guard()->factory()->getTTL() * $minuteToExpire;
    }

    private function getPasswordBroker() {
        return Password::broker();
    }

    private function credentials(ResetPasswordRequest $request) {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Get user by token
     *
     * @response {
     *  "user": {"transformer":"App\\Http\\Resources\\Users\\Presenters\\UserTransformer", "transformerModel":"App\\Http\\Resources\\Users\\Models\\User"}
     *  }
     */
    public function getByToken() {
        $user = Auth::user();
        $userResource = App::make('UsersResource');
        $userRepository = $userResource->getRepository('User');
        $user = $userRepository->findWithPresenter($user->id, 'User');
        return $this->validSuccessJsonResponse('Success', [
            'user' => $user
        ]);
    }

    /**
     * Log the user in
     *
     * @response {
     *  "token": "[token]",
     *  "expires_in": "3600",
     *  "user": {"transformer":"App\\Http\\Resources\\Users\\Presenters\\UserTransformer", "transformerModel":"App\\Http\\Resources\\Users\\Models\\User"}
     *  }
     */
    public function login(LoginRequest $request, JWTAuth $JWTAuth) {
        $userResource = App::make('UsersResource');
        $userRepository = $userResource->getRepository('User');
        $userService = $userResource->getService('Auth');
        $credentials = $request->only(['email', 'password']);
        try {
            $userActive = $userRepository->findWhere(['email' => $credentials['email'], 'active' => 1])->first();
            $token = $userService->login($credentials['email'], $credentials['password']);
            if(!$token || $userActive == null) {
                throw new AccessDeniedHttpException();
            }
        } catch (JWTException $e) {
            throw new HttpException(500);
        }
        $user = Auth::user();
        if($user->hasRole('userAdmin')){
            $user->removeRole('userAdmin');
        }
        $user = $userRepository->findWithPresenter($user->id, 'User');
        return $this->validSuccessJsonResponse('Success', [
            'token' => $token,
            'expires_in' => $this->getTokenExpireTime(),
            'user' => $user
        ]);
    }

    /**
     * Log the userUserAdmin in
     *
     * @response {
     *  "token": "[token]",
     *  "expires_in": "3600",
     *  "user": {"transformer":"App\\Http\\Resources\\Users\\Presenters\\UserTransformer", "transformerModel":"App\\Http\\Resources\\Users\\Models\\User"}
     *  }
     */
    public function loginUserAdmin(LoginRequest $request, JWTAuth $JWTAuth) {
        $userResource = App::make('UsersResource');
        $userRepository = $userResource->getRepository('User');
        $userService = $userResource->getService('Auth');
        $credentials = $request->only(['email', 'password']);
        try {
            $userActive = $userRepository->findWhere(['email' => $credentials['email'], 'active' => 1])->first();
            $token = $userService->login($credentials['email'], $credentials['password'], 10);
            if(!$token || $userActive == null) {
                throw new AccessDeniedHttpException();
            }
        } catch (JWTException $e) {
            throw new HttpException(500);
        }
        $user = Auth::user();
        $user->assignRole('userAdmin');
        $user = $userRepository->findWithPresenter($user->id, 'User');
        return $this->validSuccessJsonResponse('Success', [
            'token' => $token,
            'expires_in' => $this->getTokenExpireTime(),
            'user' => $user
        ]);
    }
    /**
     * Log the user out (Invalidate the token)
     *
     * @authenticated
     */
    public function logout() {
        $userResource = App::make('UsersResource');
        $userService = $userResource->getService('Auth');
        $userService->logout();
        return $this->validSuccessJsonResponse('Success', ['message' => 'Successfully logged out']);
    }

    /**
     * Signup the user
     *
     * @response {
     *  "token": "[token]",
     *  "expires_in": "3600",
     *  "user": {"transformer":"App\\Http\\Resources\\Users\\Presenters\\UserTransformer", "transformerModel":"App\\Http\\Resources\\Users\\Models\\User", "query":{"email":"user@mail.com"}}
     *  }
     */

    public function signUp(SignUpRequest $request, JWTAuth $JWTAuth){
        $userResource = App::make('UsersResource');
        $userService = $userResource->getService('Auth');
        $userRepository = $userResource->getRepository('User');
        $request->merge(['role' => 'user']);
        try {
            $user = $userService->signup((object) $request->all());
        } catch(SignUpException $e) {
            throw new ConflictHttpException('User is already present');
        } catch(Exception $e) {
            throw new HttpException(500);
        }
        $token = $JWTAuth->fromUser($user);
        $user->profile()->create(['user_id' => $user->id]);
        $user = $userRepository->findWithPresenter($user->id, 'User');
        return $this->validSuccessJsonResponse('Success', [
            'token' => $token,
            'user' => $user,
            'expires_in' => $this->getTokenExpireTime()
        ]);
    }

    /**
     * Refresh a token.
     * @authenticated
     * @response {
     *  "token": "[token]",
     *  "expires_in": "3600",
     *  }
     */
    public function refresh() {
        $userResource = App::make('UsersResource');
        $userService = $userResource->getService('Auth');
        $token = $userService->refresh();
        return $this->validSuccessJsonResponse('Success', [
            'token' => $token,
            'expires_in' => $this->getTokenExpireTime()
        ]);
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
        //$user->profile()->create(['user_id' => $user->id]);
        $user = $userRepository->findWithPresenter($user->id, 'User');
        return $this->validSuccessJsonResponse('Success', [
            'token' => $token,
            'expires_in' => $this->getTokenExpireTime(),
            'user' => $user
        ]);
    }

    /**
     * Change user password.
     *
     */
    public function changePassword(ChangePasswordRequest $request) {
        $user = Auth::user();
        if ((!Hash::check($request->oldPassword, $user->password) && !Hash::check('social', $user->password)) || !$user->hasRole('userAdmin')) {
            throw new UnprocessableEntityHttpException();
        }
        $userResource = App::make('UsersResource');
        $userRepository = $userResource->getRepository('User');
        $userRepository->update(['password' => $request->password], $user->id);
        return $this->validSuccessJsonResponse('Success');
    }

    /**
     * Change user email.
     *
     */
    public function changeEmail(ChangeEmailRequest $request) {
        $user = Auth::user();
        if (!$user->hasRole('userAdmin')) {
            throw new UnprocessableEntityHttpException();
        }
        $userResource = App::make('UsersResource');
        $userRepository = $userResource->getRepository('User');
        $userRepository->update(['email' => $request->email], $user->id);
        return $this->validSuccessJsonResponse('Success', [
            'email' => $request->email
        ]);
    }

}

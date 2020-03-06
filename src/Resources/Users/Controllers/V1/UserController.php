<?php

namespace App\Http\Resources\Users\Controllers\V1;

use UncleProject\UncleLaravel\Controllers\ApiResourceDefaultController;
use App\Http\Resources\Users\Repositories\UserRepository;

/**
 * @group User
 *
 * APIs for managing user
 */

class UserController extends ApiResourceDefaultController {

    protected $repository = UserRepository::class;

    protected $resourceName = 'users';

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

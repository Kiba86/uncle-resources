<?php

namespace App\Http\Resources\Users\Controllers\V1;

use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use UncleProject\UncleLaravel\Controllers\ApiResourceDefaultController;
use App\Http\Resources\Users\Requests\UserProfileRequest;
use App\Http\Resources\Users\Repositories\UserProfileRepository;
use App\Http\Resources\Users\Presenters\UserProfilePresenter;
use Illuminate\Http\Request;
use Auth;
use App;
use Hash;

/**
 * @group User
 *
 * APIs for managing user
 */

class UserProfileController extends ApiResourceDefaultController {

    protected $repository = UserProfileRepository::class;

    protected $formRequest = UserProfileRequest::class;

    protected $updatePresenter = UserProfilePresenter::class;

    protected $resourceName = 'users';

    /**
     * Show user profile
     * @transformerModel App\Http\Resources\Users\Models\UserProfile
     */
    public function show(Request $request, $key) {
        return parent::show($request, $key);
    }

    /**
     * Insert user profile
     * @transformerModel App\Http\Resources\Users\Models\UserProfile
     *
     */
    public function store(Request $request) {
        return parent::store($request);
    }

    /**
     * Update user profile
     * @transformerModel App\Http\Resources\Users\Models\UserProfile
     *
     */
    public function update(Request $request, $key) {

        if($request->firstName || $request->lastName || $request->phoneNumber) {
            $user = Auth::user();
            if (!$user->hasRole('userAdmin')) {
                throw new UnprocessableEntityHttpException();
            }
        }
        return parent::update($request, $key);
    }

    public function showImage($id, $imageName) {
        return $this->renderImage('user_profiles', $id, $imageName);
    }

}

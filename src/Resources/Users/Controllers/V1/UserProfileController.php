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
     * @transformerModel App\Http\Resources\Users\Models\User
     */
    public function show(Request $request, $key = '') {
        $user = Auth::user();
        return parent::show($request, $user->id);
    }

    /**
     * Insert user profile
     * @transformerModel App\Http\Resources\Users\Models\User
     *
     */
    public function store(Request $request) {
        return parent::store($request);
    }

    /**
     * Update user profile
     * @transformerModel App\Http\Resources\Users\Models\User
     *
     */
    public function update(Request $request, $key = '') {
        $user = Auth::user();
        return parent::update($request, $user->id);
    }

    public function showImage($imageName) {
        $user = Auth::user();
        return $this->renderImage('user_profiles', $user->id, $imageName);
    }

}

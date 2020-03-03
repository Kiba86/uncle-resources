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

}

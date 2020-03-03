<?php

namespace App\Http\Resources\Users\Repositories;

use UncleProject\UncleLaravel\Classes\BaseRepository;
use App;

class UserSocialAccountRepository extends BaseRepository {

    public $resourceName = 'users';
    public $modelName = 'UserSocialAccount';

}

<?php

namespace App\Http\Resources\Users\Repositories;

use UncleProject\UncleLaravel\Classes\BaseRepository;
use App;

class UserProfileRepository extends BaseRepository {

    public $resourceName = 'users';
    public $modelName = 'UserProfile';

}

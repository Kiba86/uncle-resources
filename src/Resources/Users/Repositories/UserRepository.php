<?php

namespace App\Http\Resources\Users\Repositories;

use UncleProject\UncleLaravel\Classes\BaseRepository;
use App;

class UserRepository extends BaseRepository {

    public $resourceName = 'users';
    public $modelName = 'user';

}

<?php

namespace App\Http\Resources\Tags\Repositories;

use UncleProject\UncleLaravel\Classes\BaseRepository;
use App;

class TagRepository extends BaseRepository {

    protected $fieldSearchable = [
        'id',
        'name' => 'like'
    ];

    public $resourceName = 'tags';
    public $modelName = 'tag';

}

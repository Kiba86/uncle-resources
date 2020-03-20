<?php

namespace App\Http\Resources\Comments\Repositories;

use UncleProject\UncleLaravel\Classes\BaseRepository;
use App;

class CommentRepository extends BaseRepository {

    protected $fieldSearchable = [

    ];

    public $resourceName = 'comments';
    public $modelName = 'comment';

}

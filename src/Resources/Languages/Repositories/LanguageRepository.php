<?php

namespace App\Http\Resources\Languages\Repositories;

use UncleProject\UncleLaravel\Classes\BaseRepository;
use App;

class LanguageRepository extends BaseRepository {

    protected $fieldSearchable = [
        'name' => 'like',
        'code'
    ];

    public $resourceName = 'languages';
    public $modelName = 'language';

}

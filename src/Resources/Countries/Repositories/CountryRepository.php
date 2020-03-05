<?php

namespace App\Http\Resources\Countries\Repositories;

use UncleProject\UncleLaravel\Classes\BaseRepository;
use App;

class CountryRepository extends BaseRepository {

    protected $fieldSearchable = [
        'name' => 'like',
        'code'
    ];

    public $resourceName = 'countries';
    public $modelName = 'country';

}

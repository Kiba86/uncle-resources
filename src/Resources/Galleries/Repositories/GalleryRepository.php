<?php

namespace App\Http\Resources\Galleries\Repositories;

use UncleProject\UncleLaravel\Classes\BaseRepository;
use App;

class GalleryRepository extends BaseRepository {

    protected $fieldSearchable = [
        'name' => 'like'
    ];

    public $resourceName = 'galleries';
    public $modelName = 'gallery';

}

<?php

namespace App\Http\Resources\Images\Repositories;

use UncleProject\UncleLaravel\Classes\BaseRepository;
use App;

class ImageRepository extends BaseRepository {

    public $resourceName = 'images';
    public $modelName = 'image';

    protected $fieldSearchable = [
        'gallery_id'
    ];
}

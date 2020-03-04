<?php

namespace App\Http\Resources\Galleries\Controllers\V1;

use UncleProject\UncleLaravel\Controllers\ApiResourceDefaultController;
use App\Http\Resources\Galleries\Repositories\GalleryRepository;
use App\Http\Resources\Galleries\Requests\GalleryRequest;
use App\Http\Resources\Galleries\Presenters\GalleryPresenter;

/**
 * @group Galleries
 *
 * APIs for managing Galleries
 */

class GalleryController extends ApiResourceDefaultController {

    protected $repository = GalleryRepository::class;

    protected $formRequest = GalleryRequest::class;

    protected $indexPresenter = GalleryPresenter::class;
    
    protected $resourceName = 'galleries';

}

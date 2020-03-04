<?php

namespace App\Http\Resources\Galleries\Controllers\V1;

use UncleProject\UncleLaravel\Controllers\ApiResourceDefaultController;
use App\Http\Resources\Images\Repositories\ImageRepository;
use App\Http\Resources\Images\Requests\ImageRequest;
use App\Http\Resources\Images\Presenters\ImagePresenter;

/**
 * @group Images
 *
 * APIs for managing images
 */

class ImageController extends ApiResourceDefaultController {

    protected $repository = ImageRepository::class;

    protected $formRequest = ImageRequest::class;

    protected $resourceName = 'images';

    protected $indexPresenter = ImagePresenter::class;

    protected $storePresenter = ImagePresenter::class;

    protected $showPresenter = ImagePresenter::class;

    protected $updatePresenter = ImagePresenter::class;

    public function showImage($id, $imageName) {
        return $this->renderImage('images', $id, $imageName);
    }

}

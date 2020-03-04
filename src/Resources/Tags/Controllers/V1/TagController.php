<?php

namespace App\Http\Resources\Tags\Controllers\V1;

use UncleProject\UncleLaravel\Controllers\ApiResourceDefaultController;
use App\Http\Resources\Tags\Repositories\TagRepository;
use App\Http\Resources\Tags\Presenters\TagPresenter;
use App\Http\Resources\Tags\Requests\TagRequest;

/**
 * @group Tags
 *
 * APIs for managing tags
 */

class TagController extends ApiResourceDefaultController {

    protected $repository = TagRepository::class;

    protected $formRequest = TagRequest::class;

    protected $resourceName = 'tags';

    protected $indexPresenter = TagPresenter::class;

    protected $storePresenter = TagPresenter::class;

    protected $showPresenter = TagPresenter::class;

    protected $updatePresenter = TagPresenter::class;

}

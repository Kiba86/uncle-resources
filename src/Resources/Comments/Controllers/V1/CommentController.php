<?php

namespace App\Http\Resources\Comments\Controllers\V1;

use UncleProject\UncleLaravel\Controllers\ApiResourceDefaultController;
use App\Http\Resources\Comments\Repositories\CommentRepository;
use App\Http\Resources\Comments\Requests\CommentRequest;
use App\Http\Resources\Comments\Presenters\CommentPresenter;
use Illuminate\Http\Request;
use Storage;

/**
 * @group Comments
 *
 * APIs for managing {}
 */

class CommentController extends ApiResourceDefaultController {

    protected $repository = CommentRepository::class;

    protected $formRequest = CommentRequest::class;

    protected $indexPresenter = CommentPresenter::class;

    protected $storePresenter = CommentPresenter::class;

    protected $showPresenter = CommentPresenter::class;

    protected $updatePresenter = CommentPresenter::class;

    protected $resourceName = 'Comments';
    
    

}

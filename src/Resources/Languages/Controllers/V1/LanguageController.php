<?php

namespace App\Http\Resources\Languages\Controllers\V1;

use UncleProject\UncleLaravel\Controllers\ApiResourceDefaultController;
use App\Http\Resources\Languages\Repositories\LanguageRepository;
use App\Http\Resources\Languages\Requests\LanguageRequest;
use App\Http\Resources\Languages\Presenters\LanguagePresenter;

/**
 * @group Languages
 *
 * APIs for managing languages
 */

class LanguageController extends ApiResourceDefaultController {

    protected $repository = LanguageRepository::class;

    protected $formRequest = LanguageRequest::class;

    protected $indexPresenter = LanguagePresenter::class;
    
    protected $resourceName = 'languages';

}

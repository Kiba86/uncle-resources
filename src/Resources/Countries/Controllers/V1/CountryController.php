<?php

namespace App\Http\Resources\Countries\Controllers\V1;

use UncleProject\UncleLaravel\Controllers\ApiResourceDefaultController;
use App\Http\Resources\Countries\Repositories\CountryRepository;
use App\Http\Resources\Countries\Requests\CountryRequest;
use App\Http\Resources\Countries\Presenters\CountryPresenter;

/**
 * @group Countries
 *
 * APIs for managing countries
 */

class CountryController extends ApiResourceDefaultController {

    protected $repository = CountryRepository::class;

    protected $formRequest = CountryRequest::class;

    protected $indexPresenter = CountryPresenter::class;

    protected $resourceName = 'countries';

}

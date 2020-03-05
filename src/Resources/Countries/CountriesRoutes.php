<?php

namespace App\Http\Resources\Countries;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;
use App;

$api = app(Router::class);

$api->version('v1', function ($api) {
    $api->get('countries', App::make('CountriesResource')->getControllerClassPath('Country').'@index');
});

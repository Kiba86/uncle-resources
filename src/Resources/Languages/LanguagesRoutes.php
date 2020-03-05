<?php

namespace App\Http\Resources\Languages;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;
use App;

$api = app(Router::class);

$api->version('v1', function ($api) {
    $api->get('languages', App::make('LanguagesResource')->getControllerClassPath('Language').'@index');
});

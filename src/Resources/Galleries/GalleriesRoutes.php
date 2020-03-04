<?php

namespace App\Http\Resources\Galleries;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;
use App;

$api = app(Router::class);

$api->version('v1', function ($api) {
    $api->group(['middleware' => ['role:user']], function ($api) {
        $api->get('galleries', App::make('GalleriesResource')->getControllerClassPath('Gallery') . '@index');
        $api->get('galleries/{id}', App::make('GalleriesResource')->getControllerClassPath('Gallery') . '@show');
        $api->post('galleries', App::make('GalleriesResource')->getControllerClassPath('Gallery') . '@store');
        $api->match(['put', 'patch'], 'galleries/{id}', App::make('GalleriesResource')->getControllerClassPath('Gallery') . '@update');
        $api->delete('galleries/{id}', App::make('GalleriesResource')->getControllerClassPath('Gallery') . '@destroy');
        $api->delete('galleries', App::make('GalleriesResource')->getControllerClassPath('Gallery') . '@destroyMany');
    });
});

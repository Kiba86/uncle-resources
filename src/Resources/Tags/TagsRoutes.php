<?php

namespace App\Http\Resources\Tags;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;
use App;

$api = app(Router::class);

$api->version('v1', function ($api) {
    $api->group(['middleware' => ['role:user']], function ($api) {
        $api->get('tags', App::make('TagsResource')->getControllerClassPath('Tag') . '@index');
        $api->get('tags/{id}', App::make('TagsResource')->getControllerClassPath('Tag') . '@show');
        $api->post('tags', App::make('TagsResource')->getControllerClassPath('Tag') . '@store');
        $api->match(['put', 'patch'], 'tags/{id}', App::make('TagsResource')->getControllerClassPath('Tag') . '@update');
        $api->delete('tags/{id}', App::make('TagsResource')->getControllerClassPath('Tag') . '@destroy');
        $api->delete('tags', App::make('TagsResource')->getControllerClassPath('Tag') . '@destroyMany');
    });
});

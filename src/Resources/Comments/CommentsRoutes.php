<?php

namespace App\Http\Resources\Comments;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;
use App;

$api = app(Router::class);

$api->version('v1', function ($api) {
    $api->get('comments', App::make('CommentsResource')->getControllerClassPath('Comment').'@index');
    $api->post('comments', App::make('CommentsResource')->getControllerClassPath('Comment').'@store');
    $api->delete('comments', App::make('CommentsResource')->getControllerClassPath('Comment').'@destroyMany');
    $api->get('comments/{id}', App::make('CommentsResource')->getControllerClassPath('Comment').'@show');
    $api->match(['put', 'patch'],'comments/{id}', App::make('CommentsResource')->getControllerClassPath('Comment').'@update');
    $api->delete('comments/{id}', App::make('CommentsResource')->getControllerClassPath('Comment').'@destroy');
});

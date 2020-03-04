<?php

namespace App\Http\Resources\Tags;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;
use App;

$api = app(Router::class);

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'auth'], function(Router $api) {
        $api->post('login', App::make('UsersResource')->getControllerClassPath('Auth').'@login');
        $api->post('signup/user', App::make('UsersResource')->getControllerClassPath('Auth').'@signUp');
        $api->post('refresh', App::make('UsersResource')->getControllerClassPath('Auth').'@refresh');
        $api->post('recovery', App::make('UsersResource')->getControllerClassPath('Auth').'@recovery');
        $api->post('reset', [
            'uses' => App::make('UsersResource')->getControllerClassPath('Auth').'@resetPassword',
            'as' => 'password.reset'
        ]);
        $api->group(['middleware' => ['jwt.auth']], function ($api) {
            $api->post('logout', App::make('UsersResource')->getControllerClassPath('Auth').'@logout');
        });

        $api->get('social/{driver}', [
            'uses' => App::make('UsersResource')->getControllerClassPath('Auth').'@socialRedirectToProvider',
            'as' => 'social.oauth'
        ]);
        $api->post('social/{driver}/callback', [
            'uses' => App::make('UsersResource')->getControllerClassPath('Auth').'@socialHandleProviderCallback',
            'as' => 'social.callback'
        ]);
    });



    $api->group(['middleware' => ['role:user']], function ($api) {
        $api->get('user', App::make('UsersResource')->getControllerClassPath('Auth').'@getByToken');

        $api->post('users/profile', App::make('UsersResource')->getControllerClassPath('UserProfile').'@store');
        $api->group(['middleware' => ['owner:Users,UserProfile,user_id']], function ($api) {
            $api->get('users/profile/{id}', App::make('UsersResource')->getControllerClassPath('UserProfile').'@show');
            $api->match(['put', 'patch'], 'users/profile/{id}', App::make('UsersResource')->getControllerClassPath('UserProfile').'@update');
        });

        $api->get('user_profiles/{id}/images/{imageName}', App::make('UsersResource')->getControllerClassPath('UserProfile').'@showImage');

        $api->match(['put', 'patch'], 'users/password', [
            'uses' => App::make('UsersResource')->getControllerClassPath('Auth').'@changePassword',
            'as' => 'password.change'
        ]);

        $api->match(['put', 'patch'], 'users/email', [
            'uses' => App::make('UsersResource')->getControllerClassPath('Auth').'@changeEmail',
            'as' => 'email.change'
        ]);

    });

});

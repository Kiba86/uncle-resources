<?php

namespace App\Http\Resources\ContactUs;

use Illuminate\Http\Request;
use Spatie\Honeypot\ProtectAgainstSpam;
use Dingo\Api\Routing\Router;
use App;

$api = app(Router::class);

//for testing: config()->set('honeypot.enabled', false);
$api->version('v1', function ($api) {
    $api->group(['middleware' => ['throttle:1,5', ProtectAgainstSpam::class]], function ($api) {
        $api->post('contact-us', App::make('ContactUsResource')->getControllerClassPath('ContactUs') . '@contact');
    });
});

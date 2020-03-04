<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App::make('GalleriesResource')->getModelClassPath('Gallery'), function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});

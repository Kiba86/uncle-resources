<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App::make('GalleriesResource')->getModelClassPath('Image'), function (Faker $faker) {
    $foldersRepository = App::make('GalleriesResource')->getRepository('Gallery');
    $folders = $foldersRepository->all();
    return [
        'image' => $faker->loremFlickrImageUrl(362, 180, 'travel,italy'),
        'gallery_id'  => $faker->randomElement($folders)->id,
    ];
});

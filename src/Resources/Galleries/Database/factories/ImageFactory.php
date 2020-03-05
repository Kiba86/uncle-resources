<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App::make('GalleriesResource')->getModelClassPath('Image'), function (Faker $faker) {
    $galleriesRepository = App::make('GalleriesResource')->getRepository('Gallery');
    $galleries = $galleriesRepository->all();
    return [
        'image' => $faker->loremFlickrImageUrl(362, 180, 'travel,italy'),
        'gallery_id'  => $faker->randomElement($galleries)->id,
    ];
});

<?php

namespace App\Http\Resources\Galleries\Fakers;

use Faker\Factory as Faker;
use App;

class GalleryFaker {

    public static function getStore() {
        $faker = Faker::create();
        return [
            'name'      => $faker->word,
        ];
    }

    public static function getUpdate() {
        $faker = Faker::create();

        $galleries = App::make('GalleriesResource')->getRepository('Gallery')->all();
        $gallery = $faker->randomElement($galleries);

        return [
            'id' => $gallery->id,
            'data' => [
                'name'      => $faker->word,
            ]
        ];
    }

    public static function gets($num) {
        $faker = Faker::create();
        $galleries = [];

        for($i = 0; $i < $num; $i++)
            $galleries[$i] = GalleryFaker::getStore();

        return $galleries;
    }

}

<?php

namespace App\Http\Resources\Tags\Fakers;

use Faker\Factory as Faker;
use Illuminate\Http\UploadedFile;
use App;

class TagFaker {

    public static function getStore() {
        $faker = Faker::create();

        return [
            'name' => $faker->word
        ];
    }

    public static function getUpdate() {
        $faker = Faker::create();

        $tags = App::make('TagsResource')->getRepository('Tag')->all();
        $tag = $faker->randomElement($tags);

        return [
            'id' => $tag->id,
            'data' => [
                'name' => $faker->word
            ]
        ];
    }

    public static function gets($num) {
        $faker = Faker::create();
        $tags = [];

        for($i = 0; $i < $num; $i++)
            $tags[$i] = ['name' => $faker->word];

        return $tags;
    }

}

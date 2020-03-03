<?php

namespace App\Http\Resources\Users\Fakers;

use Faker\Factory as Faker;
use Illuminate\Http\UploadedFile;
use App;

class UserProfileFaker {

    public static function get() {
        $faker = Faker::create();

        $countriesRepository = App::make('CountriesResource')->getRepository('Country');
        $countries = $countriesRepository->all();
        return [
            'nickName' => $faker->userName,
            'firstName' => $faker->firstName,
            'lastName' => $faker->lastName,
            'gender' => $faker->randomElement($array = array ('M','F')),
            'birthDate' => $faker->date,
            'country_id' => $faker->randomElement($countries)->id,
            'phonePrefix' => '+'.$faker->regexify('[0-9]{2}'),
            'phoneNumber' => $faker->regexify('[0-9]{10}'),
            'image' => UploadedFile::fake()->image('image.png')
        ];
    }

}

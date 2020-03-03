<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App::make('UsersResource')->getModelClassPath('UserProfile'), function (Faker $faker) {
    $countriesRepository = App::make('CountriesResource')->getRepository('Country');
    $countries = $countriesRepository->all();
    return [
        'email' => '',
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'gender' => $faker->randomElement($array = array ('M','F')),
        'birthDate' => $faker->date,
        'country_id' => $faker->randomElement($countries)->id,
        'phonePrefix' => '+'.$faker->regexify('[0-9]{2}'),
        'phoneNumber' => $faker->regexify('[0-9]{10}'),
    ];
});



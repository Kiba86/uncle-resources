<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(App::make('CommentsResource')->getModelClassPath('Comment'), function (Faker $faker, $params) {

    $users = App::make('UsersResource')->getRepository('User')->all();

    return [
        'user_id'        => $faker->randomElement($users)->id,
        'content'        => $faker->text(),
        'commentable_id' => $params['commentable_id']
    ];
});

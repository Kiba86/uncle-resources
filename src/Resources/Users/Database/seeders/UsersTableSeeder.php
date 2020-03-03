<?php

namespace App\Http\Resources\Users\Database\seeders;

use Illuminate\Database\Seeder;
use App;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userClass = App::make('UsersResource')->getModelClassPath('User');
        $index = 0;

        factory($userClass, 10)->create()->each(function ($user) use ($userClass, &$index){
            $user->assignRole('user');
            $userProfileClass = App::make('UsersResource')->getModelClassPath('UserProfile');
            $userProfile = factory($userProfileClass, 1)->make()[0];
            $user->profile()->save($userProfile);

            if ($index ==  0) {
                $user->email = 'user@mail.com';
                //$user->assignRole('admin');
                $user->save();
            }
            $index++;
        });
    }
}

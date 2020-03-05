<?php

namespace App\Http\Resources\Galleries\Database\seeders;

use Illuminate\Database\Seeder;
use App;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App::make('GalleriesResource')->getModelClassPath('Image'), 100)->create();
    }
}

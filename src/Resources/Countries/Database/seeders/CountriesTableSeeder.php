<?php

namespace App\Http\Resources\Countries\Database\seeders;

use Illuminate\Database\Seeder;
use Monarobase\CountryList\CountryListFacade;
use App;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countriesRepository = App::make('CountriesResource')->getRepository('Country');
        $countryList = CountryListFacade::getList('en');
        foreach ($countryList as $cl => $vl) {
            $countriesRepository->create(['code' => $cl, 'name' => $vl]);
        }
    }
}

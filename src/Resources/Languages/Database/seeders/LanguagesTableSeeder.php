<?php

namespace App\Http\Resources\Languages\Database\seeders;

use Illuminate\Database\Seeder;
use App;
use Languages;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $languagesWeight = [
            'en' => 0, // inglese
            'it' => 0, // italiano
        ];
        $enabledLanguages = array_keys($languagesWeight);
        $languagesRepository = App::make('LanguagesResource')->getRepository('Language');
        $languageListIt = Languages::getList('it');
        $languageListEn = Languages::getList('en');
        foreach ($languageListIt as $ll => $vl) {
            $nameIt = $vl;
            $nameEn = $languageListEn[$ll];
            if (in_array($ll, $enabledLanguages)) {
                $languagesRepository->create(['code' => $ll, 'name:it' => $nameIt, 'name:en' => $nameEn, 'orderWeight' => $languagesWeight[$ll]]);
            }
        }
    }
}

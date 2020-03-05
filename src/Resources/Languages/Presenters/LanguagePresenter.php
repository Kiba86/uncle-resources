<?php
namespace App\Http\Resources\Languages\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;

use League\Fractal\TransformerAbstract;
use App\Http\Resources\Languages\Models\Language;
use App;

class LanguageTransformer extends TransformerAbstract
{
    public function transform(Language $language)
    {
        $utils = App::make('Utils');

        return [
            'id' => $language->id,
            'code' => $language->code,
            'name' => $language->name
        ];
    }
}

class LanguagePresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer() {
        return new LanguageTransformer();
    }
}

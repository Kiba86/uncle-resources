<?php
namespace App\Http\Resources\Countries\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;

use League\Fractal\TransformerAbstract;
use App\Http\Resources\Countries\Models\Country;

class CountryTransformer extends TransformerAbstract
{
    public function transform(Country $country)
    {
        return [
            'id'      => (int) $country->id,
            'name' => $country->name,
            'code' =>  $country->code
        ];
    }
}

class CountryPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer() {
        return new CountryTransformer();
    }
}

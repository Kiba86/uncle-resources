<?php
namespace App\Http\Resources\Galleries\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;

use League\Fractal\TransformerAbstract;
use App\Http\Resources\Galleries\Models\Gallery;
use App;

class GalleryTransformer extends TransformerAbstract
{
    public function transform(Gallery $gallery)
    {
        $utils = App::make('Utils');

        return [
            'id' => $gallery->id,
            'name' => $gallery->name,
            'updated_at' => $gallery->updated_at,
            'imagesCount' => $gallery->images->count(),
        ];
    }
}

class GalleryPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer() {
        return new GalleryTransformer();
    }
}

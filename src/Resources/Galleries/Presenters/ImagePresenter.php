<?php
namespace App\Http\Resources\Galleries\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;

use League\Fractal\TransformerAbstract;
use App\Http\Resources\Images\Models\Image;

class ImageTransformer extends TransformerAbstract
{
    public function transform(Image $image)
    {
        return [
            'id'         => (int) $image->id,
            'image'      => $image->image,
            'image_name' => $image->image_name,
        ];
    }
}

class ImagePresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer() {
        return new ImageTransformer();
    }
}

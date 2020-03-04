<?php
namespace App\Http\Resources\Tags\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;

use League\Fractal\TransformerAbstract;
use App\Http\Resources\Tags\Models\Tag;

class TagTransformer extends TransformerAbstract
{
    public function transform(Tag $tag)
    {
        return [
            'id'   => (int) $tag->id,
            'name' => $tag->name,
        ];
    }
}

class TagPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer() {
        return new TagTransformer();
    }
}

<?php
namespace App\Http\Resources\Comments\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use League\Fractal\TransformerAbstract;
use App\Http\Resources\Comments\Models\Comment;
use App;

class CommentTransformer extends TransformerAbstract
{
    public function transform(Comment $comment)
    {
        $utils = App::make('Utils');

        return [
            'id'        => $comment->id,

        ];
    }
}

class CommentPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer() {
      return new CommentTransformer();
    }
}

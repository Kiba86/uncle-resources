<?php

namespace App\Http\Resources\Galleries\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use App;


class Imageable extends MorphPivot {

    public $fillable = [
        'image_id',
        'imageable_id',
        'imageable_type'
    ];

    public function image() {
        return $this->belongsTo(App::make('ImagesResource')->getModelClassPath('Image'));
    }


}

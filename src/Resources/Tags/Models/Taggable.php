<?php

namespace App\Http\Resources\Tags\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use App;


class Taggable extends MorphPivot {

    public $fillable = [
        'tag_id',
        'taggable_id',
        'taggable_type'
    ];

    public function tag() {
        return $this->belongsTo(App::make('TagsResource')->getModelClassPath('Tag'));
    }

}

<?php

namespace App\Http\Resources\Galleries\Models;

use Illuminate\Database\Eloquent\Model;
use Laraplus\Data\Translatable;
use App;

class Gallery extends Model {

    public $fillable = [
        'name'
    ];

    public function images(){
        return $this->hasMany(App::make('ImagesResource')->getModelClassPath('Image'));
    }

}

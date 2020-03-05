<?php

namespace App\Http\Resources\Languages\Models;

use Illuminate\Database\Eloquent\Model;
use Laraplus\Data\Translatable;

class Language extends Model {

    use Translatable;

    public $translatable = [
        'name',
    ];

    protected $withFallback = false;

    protected $onlyTranslated = true;

}

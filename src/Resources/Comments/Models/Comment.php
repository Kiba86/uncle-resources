<?php

namespace App\Http\Resources\Comments\Models;

use Illuminate\Database\Eloquent\Model;
use App;


class Comment extends Model {

    public $fillable = [
        'user_id',
        'commentable_id',
        'commentable_type',
        'content'
    ];

    public function user()
    {
        return $this->belongsTo(App::make('UsersResource')->getModelClassPath('User'));
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    //Add Relations - Uncle Comment (No Delete)
}

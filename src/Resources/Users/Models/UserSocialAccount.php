<?php

namespace App\Http\Resources\Users\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocialAccount extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'provider',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(App::make('UsersResource')->getModelClassPath('User'));
    }

}

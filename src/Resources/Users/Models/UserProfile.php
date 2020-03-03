<?php

namespace App\Http\Resources\Users\Models;

use UncleProject\UncleLaravel\Traits\HasUpload;
use Illuminate\Database\Eloquent\Model;
use App;

class UserProfile extends Model {

    use HasUpload;

    public $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'firstName', 
        'nickName',
        'lastName',
        'gender',
        'birthDate',
        'phone',
        'country_id',
        'city',
        'phonePrefix',
        'phoneNumber',
        'image',
        'user_id'
    ];

    protected $uploadable = ['image'];

    public function getUploadableId() {
        return $this->user_id;
    }

    private static function setEmail($model) {
        $model->email = $model->user()->first()->email;
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function($model){
            self::setEmail($model);
        });
    }

    public function user() {
        return $this->belongsTo(App::make('UsersResource')->getModelClassPath('User'));
    }

}

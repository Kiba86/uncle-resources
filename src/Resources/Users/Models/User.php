<?php

namespace App\Http\Resources\Users\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Resources\Users\Traits\HasProfiles;
use App\Http\Resources\Users\Traits\HasSocialAccounts;
use App\Http\Resources\Users\Notifications\ResetPasswordNotification;

use Hash;
use App;

class User extends Authenticatable implements JWTSubject, Presentable
{
    use Notifiable, HasRoles, HasProfiles, HasSocialAccounts, PresentableTrait;

    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    private static function updateProfile($model) {

        $profile = $model->profile();
        if($profile) {
            $profile->update(['email' => $model->email]);
        }
    }

    public static function boot()
    {
        parent::boot();
        self::updating(function($model){
            self::updateProfile($model);
        });
    }

    /**
     * Automatically creates hash for the user password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

}

<?php

namespace App\Http\Resources\Users\Traits;

use App;

trait HasSocialAccounts {

    public function social_accounts() {
        return $this->hasMany(App::make('UsersResource')->getModelClassPath('UserSocialAccount'));
    }
}

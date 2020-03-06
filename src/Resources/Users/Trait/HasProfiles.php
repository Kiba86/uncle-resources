<?php

namespace App\Http\Resources\Users\Traits;

use App;

trait HasProfiles {

    public function profile() {
        $roles = $this->getRoleNames()->toArray();
        if (in_array('user', $roles)) {
            return $this->hasOne(App::make('UsersResource')->getModelClassPath('UserProfile'));
        } else if (in_array('admin', $roles)) {
            return null;
        }
    }
}

<?php

namespace App\Http\Resources\Users\Requests;

use Config;
use Dingo\Api\Http\FormRequest;

class ChangePasswordRequest extends FormRequest {

    public function rules()
    {
        return [
            'oldPassword' => 'required',
            'password' => 'required|confirmed|min:8|not_in:social'
        ];
    }

    public function authorize()
    {
        return true;
    }
}

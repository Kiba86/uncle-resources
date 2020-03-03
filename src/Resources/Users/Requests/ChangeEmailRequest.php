<?php

namespace App\Http\Resources\Users\Requests;

use Config;
use Dingo\Api\Http\FormRequest;

class ChangeEmailRequest extends FormRequest {

    public function rules()
    {
        return [
            'email' => 'required|email|confirmed|unique:users,email'
        ];
    }

    public function authorize()
    {
        return true;
    }
}

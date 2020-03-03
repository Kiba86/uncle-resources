<?php

namespace App\Http\Resources\Users\Requests;

use Config;
use Dingo\Api\Http\FormRequest;

class RecoveryPasswordRequest extends FormRequest {

    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email'
        ];
    }

    public function authorize()
    {
        return true;
    }
}

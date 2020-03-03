<?php

namespace App\Http\Resources\Users\Requests;

use Config;
use Dingo\Api\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|not_in:social'
        ];
    }
    public function authorize()
    {
        return true;
    }
}

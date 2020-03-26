<?php

namespace App\Http\Resources\ContactUs\Requests;

use RafflesArgentina\ActionBasedFormRequest\ActionBasedFormRequest;


class ContactUsRequest extends ActionBasedFormRequest {

    public function rules()
    {
        return [
            'from'   => 'required|email',
            'object' => 'required|string',
            'text'   => 'required|string',
        ];
    }

    public function authorize()
    {
        return true;
    }
}

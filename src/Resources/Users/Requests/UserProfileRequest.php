<?php

namespace App\Http\Resources\Users\Requests;

use Config;
use RafflesArgentina\ActionBasedFormRequest\ActionBasedFormRequest;

class UserProfileRequest extends ActionBasedFormRequest
{
    public static function store() {
        return [
            'firstName' => 'nullable|regex:/^[A-Za-z .]+$/u|max:100',
            'lastName' => 'nullable|regex:/^[A-Za-z .\']+$/u|max:100',
            'gender' => 'nullable|in:M,F',
            'birthDate' => 'nullable|date_format:Y-m-d|before:'.date('Y-m-d'),
            'phonePrefix' => 'nullable|max:3',
            'phoneNumber' => 'nullable|phone|max:30',
            'country' => 'nullable|exists:countries,id',
            'city' => 'nullable|regex:/^[A-Za-z .]+$/u|max:100',
            'image' => 'nullable|image'
        ];
    }

    public static function update() {
        return [
            'firstName' => 'nullable|regex:/^[A-Za-z .]+$/u|max:100',
            'lastName' => 'nullable|regex:/^[A-Za-z .\']+$/u|max:100',
            'gender' => 'nullable|in:M,F',
            'birthDate' => 'nullable|date_format:Y-m-d|before:'.date('Y-m-d'),
            'phonePrefix' => 'nullable|max:3',
            'phoneNumber' => 'nullable|phone|max:30',
            'country' => 'nullable|exists:countries,id',
            'city' => 'nullable|regex:/^[A-Za-z .]+$/u|max:100',
            'image' => 'nullable|image'
        ];
    }

    public function authorize() {
        return true;
    }
}

<?php

namespace App\Http\Resources\Countries\Requests;

use UncleProject\UncleLaravel\Classes\BaseActionBasedFormRequest;

class CountryRequest extends BaseActionBasedFormRequest {

    public function authorize()
    {
        return true;
    }

    public static function index() {
        return [];
    }
}

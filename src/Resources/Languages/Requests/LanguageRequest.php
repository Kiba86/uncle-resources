<?php

namespace App\Http\Resources\Languages\Requests;

use UncleProject\UncleLaravel\Classes\BaseActionBasedFormRequest;

class LanguageRequest extends BaseActionBasedFormRequest {

    public function authorize()
    {
        return true;
    }

    public static function index() {
        return [];
    }
}

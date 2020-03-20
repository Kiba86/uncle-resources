<?php

namespace App\Http\Resources\Comments\Requests;

use UncleProject\UncleLaravel\Classes\BaseActionBasedFormRequest;

class CommentRequest extends BaseActionBasedFormRequest {

    public function authorize()
    {
        return true;
    }

    public static function index() {
        return [];
    }

    public static function store() {
        return [

        ];
    }

    public static function update() {
        return [

        ];
    }
}

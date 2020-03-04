<?php

namespace App\Http\Resources\Tags\Requests;

use UncleProject\UncleLaravel\Classes\BaseActionBasedFormRequest;

class TagRequest extends BaseActionBasedFormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public static function store() {

        return [
            'name'           => 'required|max:100|unique:tags,name',
        ];
    }

    public static function update() {
        return [
            'name'           => 'required|max:100|unique:tags,name,'.request()->route('id'),
        ];
    }
}

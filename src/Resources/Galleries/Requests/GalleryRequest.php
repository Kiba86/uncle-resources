<?php

namespace App\Http\Resources\Galleries\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }
    public static function store() {

        return [
            'name'           => 'required|max:100|unique:galleries,name',
        ];
    }

    public static function update() {
        return [
            'name'           => 'required|max:100|unique:galleries,name,'.request()->route('id'),
        ];
    }
}

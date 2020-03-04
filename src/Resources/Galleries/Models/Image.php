<?php

namespace App\Http\Resources\Galleries\Models;

use UncleProject\UncleLaravel\Traits\HasUpload;
use Illuminate\Database\Eloquent\Model;
use App;

class Image extends Model
{
    use HasUpload;

    public $fillable = [
        'image',
        'image_name',
        'gallery_id'
    ];

    protected $hidden = [
        'pivot'
    ];

    protected $uploadable = ['image'];
}

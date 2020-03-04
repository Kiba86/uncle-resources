<?php

namespace App\Http\Resources\Tags\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App;

class Tag extends Model implements Searchable
{
    public $fillable = [
        'name'
    ];

    protected $hidden = [
        'pivot'
    ];

    public function getSearchResult(): SearchResult {
        return new SearchResult(
            $this,
            $this->name
        );
    }

}

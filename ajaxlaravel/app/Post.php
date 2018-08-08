<?php

namespace App;

use App\Category;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id', 'propinsi_id', 'kabupaten_id', 'kecamatan_id', 'title', 'body', 'photo'
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }
}

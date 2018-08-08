<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $fillable = [
        'kabupaten', 'propinsi_id'
    ];
}

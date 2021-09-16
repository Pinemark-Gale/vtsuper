<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $fillable = [
        'source'
    ];

    /* Eloquent relationship for source->resource */
    public function resource()
    {
        return $this->hasMany(Resource::class);
    }
}

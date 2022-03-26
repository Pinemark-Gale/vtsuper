<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'type'
    ];

    /* Eloquent relationship for resourceType->Resource */
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceTag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'tag'
    ];
    
    /* Eloquent relationship for finding many resources 
     * with resourceTag->resources 
     * */
    public function resources()
    {
        return $this->belongsToMany(Resource::class);
    }

}

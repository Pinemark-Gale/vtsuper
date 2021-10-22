<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'resource_type_id',
        'source_id',
        'name',
        'link',
        'description'
    ];
 
    /* Eloquent relationship for $resource->type */
    public function type()
    {
        return $this->belongsTo(ResourceType::class, 'resource_type_id');
    }

    /* Eloquent relationship for finding many tags 
     * with resource->tags
     * 
     * To insert: $resource->tags()->attach($tag);
     *  */
    public function tags()
    {
        return $this->belongsToMany(ResourceTag::class);
    }

    /* Eloquent relationship for resource->source */
    public function source()
    {
        return $this->belongsTo(Source::class);
    }
    

}

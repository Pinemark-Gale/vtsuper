<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'resource_id',
        'name',
        'slug',
        'instructions',
        'minutes_to_complete',
    ];

    /* Eloquent relationship for $activityDetail->author */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /* Eloquent relationship for $activityDetail->resource */
    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    /* Eloquent relationship for $activityDetail->questions */
    public function questions()
    {
        return $this->hasMany(ActivityQuestion::class);
    }

    /* Eloquent relationship for $activityDetail->submissions */
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    /* Find user related submissions. */
    public function mySubmissions()
    {
        return $this->submissions->where('user_id', '=', auth()->user()->id);
    }

}

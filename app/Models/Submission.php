<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'activity_detail_id',
        'user_id',
    ];

    /* Eloquent relationship for $submission->activity */
    public function activity()
    {
        return $this->belongsTo(ActivityDetail::class, 'activity_detail_id');
    }

    /* Eloquent relationship for $submission->user */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /* Eloquent relationship for $submission->questions */
    public function questions()
    {
        return $this->hasMany(SubmissionQuestion::class);
    }
}

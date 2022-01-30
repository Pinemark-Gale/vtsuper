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
        'question',
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

    /* Eloquent relationship for $submission->fitb */
    public function fitb()
    {
        return $this->hasMany(SubmissionAnswerFITB::class);
    }

    /* Eloquent relationship for $submission->mc */
    public function mc()
    {
        return $this->hasMany(SubmissionAnswerMC::class);
    }

    /* Eloquent relationship for $submission->sa */
    public function sa()
    {
        return $this->hasMany(SubmissionAnswerSA::class);
    }

}

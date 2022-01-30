<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityAnswer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'activity_question_id',
        'activity_answer_type_id',
    ];

    /* Eloquent relationship for $activityAnswer->question */
    public function question()
    {
        return $this->belongsTo(ActivityQuestion::class, 'activity_question_id');
    }

    /* Eloquent relationship for $activityAnswer->type */
    public function type()
    {
        return $this->belongsTo(ActivityAnswerType::class, 'activity_answer_type_id');
    }

    /* Eloquent relationship for $activityAnswer->fitb */
    public function fitb()
    {
        return $this->hasMany(ActivityAnswerFITB::class);
    }
    
    /* Eloquent relationship for $activityAnswer->mc */
    public function mc()
    {
        return $this->hasMany(ActivityAnswerMC::class);
    }

    /* Eloquent relationship for $activityAnswer->sa */
    public function sa()
    {
        return$this->hasMany(ActivityAnswerSA::class);
    }
    
}

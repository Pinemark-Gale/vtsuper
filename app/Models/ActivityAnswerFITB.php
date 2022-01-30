<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityAnswerFITB extends Model
{
    use HasFactory;

    /* specifying table name */
    protected $table = 'activity_answer_fitb';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'activity_answer_id',
        'response',
    ];

    /* Eloquent relationship for $activityAnswerFITB->answer */
    public function answer() {
        return $this->belongsTo(ActivityAnswer::class, 'activity_answer_id');
    }

}

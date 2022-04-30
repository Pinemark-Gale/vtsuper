<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionAnswerFITB extends Model
{
    use HasFactory;

    /* specifying table name */
    protected $table = 'submission_answer_fitb';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'submission_question_id',
        'response',
    ];

    /* Eloquent relationship for $submissionAnswerFITB->question */
    public function question()
    {
        return $this->belongsTo(SubmissionQuestion::class, 'submission_question_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionAnswerSA extends Model
{
    use HasFactory;

    /* specifying table name */
    protected $table = 'submission_answer_sa';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'submission_question_id',
        'response',
    ];

    /* Eloquent relationship for $submissionAnswerSA->question */
    public function question()
    {
        return $this->belongsTo(SubmissionQuestion::class, 'submission_question_id');
    }
    
}

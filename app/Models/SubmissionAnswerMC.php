<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionAnswerMC extends Model
{
    use HasFactory;

    /* specifying table name */
    protected $table = 'submission_answer_mc';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'submission_question_id',
        'response',
        'placement',
        'correct',
        'selected'
    ];

    /* Eloquent relationship for $submissionAnswerMC->question */
    public function question()
    {
        return $this->belongsTo(SubmissionQuestion::class, 'submission_question_id');
    }

}

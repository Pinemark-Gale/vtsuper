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
        'submission_id',
        'response',
    ];

    /* Eloquent relationship for $submissionAnswerSA->page */
    public function answer()
    {
        return $this->belongsTo(Submission::class, 'submission_id');
    }
    
}

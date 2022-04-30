<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionQuestion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'submission_id',
        'question',
        'type'
    ];

    /* Eloquent relationship for $submissionQuestion->submission */
    public function submission()
    {
        return $this->belongsTo(Submission::class, 'submission_id');
    }

    /* Eloquent relationship for $submissionQuestion->fitb */
    public function fitb()
    {
        return $this->hasMany(SubmissionAnswerFITB::class);
    }

    /* Eloquent relationship for $submissionQuestion->mc */
    public function mc()
    {
        return $this->hasMany(SubmissionAnswerMC::class);
    }

    /* Eloquent relationship for $submissionQuestion->sa */
    public function sa()
    {
        return $this->hasMany(SubmissionAnswerSA::class);
    }

    /* Gets a beautified version of type. */
    public function type()
    {
        $type = $this->type;
        $pretty_type = "";

        if (is_null($type)) {
            return "Question has no type set yet...";
        } else {
            switch ($type) {
                case "fitb":
                    $pretty_type = "Fill in the Blank";
                    break;
                case "mc":
                    $pretty_type = "Multiple Choice";
                    break;
                case "sa":
                    $pretty_type = "Short Answer";
                    break;
            }

            return $pretty_type;
        };
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityQuestion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'activity_detail_id',
        'question'
    ];

    public function activities()
    {
        return $this->belongsTo(ActivityDetail::class);
    }

    public function answers()
    {
        return $this->hasMany(ActivityAnswer::class);
    }

    public function type()
    {
        $type = $this->answers[0]->type->type;
        $pretty_type = "";

        if (is_null($type)) {
            return "Question has no answers set yet...";
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

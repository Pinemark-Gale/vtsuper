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
}

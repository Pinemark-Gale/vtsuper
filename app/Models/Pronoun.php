<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pronoun extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'pronouns',
    ];

    /* Eloquent relationship for pronoun->users */
    public function users()
    {
        return $this->hasMany(User::class);
    }

}

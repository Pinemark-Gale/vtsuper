<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'section'
    ];

    /* Eloquent relationship for $pageSection->page */
    public function page()
    {
        return $this->belongsToMany(Page::class);
    }
}

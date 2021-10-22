<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'status'
    ];

    /* Eloquent relationship for $pageStatus->page */
    public function page()
    {
        return $this->hasMany(Page::class);
    }
}

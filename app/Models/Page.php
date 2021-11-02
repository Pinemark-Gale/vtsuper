<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'page_status_id',
        'page_section_id',
        'title',
        'slug',
        'content',
    ];

    /* Eloquent relationship for $page->author */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /* Eloquent relationship for $page->status */
    public function status()
    {
        return $this->belongsTo(PageStatus::class, 'page_status_id');
    }

    /* Eloquent relationship for $page->section */
    public function section()
    {
        return $this->belongsTo(PageSection::class, 'page_section_id');
    }
}

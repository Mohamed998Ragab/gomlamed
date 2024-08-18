<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['blog_id', 'language_id', 'title', 'summary', 'description'];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}

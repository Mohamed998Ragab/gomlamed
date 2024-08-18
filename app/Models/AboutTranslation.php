<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['about_id','language_id', 'first_title',
        'first_description','second_title','second_description',
        'third_title','third_description'
    ];

    public function about()
    {
        return $this->belongsTo(About::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}

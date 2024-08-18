<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstBannerTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['first_banner_id','language_id','title','description'];

    // Define the inverse relationship with Category
    public function firstBanner()
    {
        return $this->belongsTo(FirstBanner::class);
    }

    // Define the relationship with Language
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}

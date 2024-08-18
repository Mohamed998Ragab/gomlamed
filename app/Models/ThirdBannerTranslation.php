<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThirdBannerTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['third_banner_id','language_id','title','description'];

    // Define the inverse relationship with Category
    public function thirdBanner()
    {
        return $this->belongsTo(ThirdBanner::class);
    }

    // Define the relationship with Language
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}

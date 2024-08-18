<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];

    // Define the one-to-many relationship with CategoryTranslation
    public function categoryTranslations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function sliderTranslations()
    {
        return $this->hasMany(SliderTranslation::class);
    }
    public function firstBannerTranslations()
    {
        return $this->hasMany(FirstBannerTranslation::class);
    }
    public function secondBannerTranslations()
    {
        return $this->hasMany(SecondBannerTransaltion::class);
    }

    public function thirdBannerTranslations()
    {
        return $this->hasMany(ThirdBannerTranslation::class);
    }

    public function blogTranslations()
    {
        return $this->hasMany(BlogTranslation::class);
    }

    public function aboutTranslations()
    {
        return $this->hasMany(AboutTranslation::class);
    }

    public function productTranslations()
    {
        return $this->hasMany(ProductTranslation::class);
    }
    
}

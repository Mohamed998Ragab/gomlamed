<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'price', 'discount', 'category_id'];

    public function translations()
    {
        return $this->hasMany(ProductTranslation::class);
    }

    // Helper method to get the translation for a specific language

    public function translation($languageCode = null)
    {
        $languageCode = $languageCode ?? app()->getLocale();
        $language = Language::where('code', $languageCode)->first();
        $translation = $this->translations()->where('language_id', $language->id ?? 0)->first();
        
        if (!$translation) {
            // Fallback to English if translation is not found
            $englishLanguage = Language::where('code', 'en')->first();
            $translation = $this->translations()->where('language_id', $englishLanguage->id)->first();
        }

        return $translation;

    }

    // Define one-to-many relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function topProduct()
    {
        return $this->hasOne(TopProduct::class);
    }

    public function getIsTopProductAttribute()
    {
        return $this->topProduct()->exists();
    }


}

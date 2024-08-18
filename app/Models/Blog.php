<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'image'];

    public function translations()
    {
        return $this->hasMany(BlogTranslation::class);
    }

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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'language_id', 'name'];

    // Define the inverse relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Define the relationship with Language
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}

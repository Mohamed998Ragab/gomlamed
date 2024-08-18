<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;

    protected $fillable =['product_id', 'language_id', 'title', 'description'];

    // Define the inverse relationship with Category
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Define the relationship with Language
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}

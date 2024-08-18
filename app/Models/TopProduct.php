<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopProduct extends Model
{
    use HasFactory;

    protected $fillable = ['product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function topProducts()
    {
        $topProducts = TopProduct::with('product.translations.language')->get();

        return view('front.product.top', compact('topProducts'));
    }

}

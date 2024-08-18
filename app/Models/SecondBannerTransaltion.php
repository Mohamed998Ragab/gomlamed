<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecondBannerTransaltion extends Model
{
    use HasFactory;

    protected $fillable = ['second_banner_id','language_id','title','description'];

    // Define the inverse relationship with Category
    public function secondBanner()
    {
        return $this->belongsTo(SecondBanner::class);
    }

    // Define the relationship with Language
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}

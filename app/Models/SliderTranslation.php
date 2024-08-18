<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['slider_id', 'language_id','title', 'second_title', 'description'];

    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}

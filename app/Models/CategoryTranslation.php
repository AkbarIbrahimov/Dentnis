<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'language_id', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function languages()
    {
        return $this->hasMany(Language::class,'id','language_id');

    }
}

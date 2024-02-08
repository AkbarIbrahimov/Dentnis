<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'slug',
    ];

    public function category()
    {
        return $this->hasMany(CategoryTranslation::class,'category_id','category_id');
    }
    public function translations()
    {
        return $this->hasMany(BlogTranslation::class,'blog_id','id');
    }
    public function languages()
    {
        return $this->hasManyThrough(
            Language::class,
            BlogTranslation::class,
            'blog_id',
            'id',
            'id',
            'language_id'
        );
    }

}

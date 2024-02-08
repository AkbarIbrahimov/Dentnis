<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotesTranslation extends Model
{
    use HasFactory;
    protected $fillable = [
        'quote_id','language_id','title','description'
    ];

    public function languages()
    {
        return $this->hasMany(Language::class,'id','language_id');

    }

}

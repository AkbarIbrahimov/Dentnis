<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['teams_id', 'language_id', 'position'];

    public function languages()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

}

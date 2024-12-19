<?php

namespace App\Models\Crawler;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;

    protected $fillable = ['keyword'];

    public function searches()
    {
        return $this->belongsToMany(Search::class, 'search_keyword');
    }
}

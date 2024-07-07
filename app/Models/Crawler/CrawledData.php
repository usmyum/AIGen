<?php

namespace App\Models\Crawler;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrawledData extends Model
{
    use HasFactory;

    protected $fillable = ['search_id', 'content', 'url'];

    public function search()
    {
        return $this->belongsTo(Search::class);
    }
}

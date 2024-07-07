<?php

namespace App\Models\Crawler;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory;

    protected $table = 'searches';
    protected $fillable = ['user_id', 'url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class, 'search_keyword');
    }

    public function crawledData()
    {
        return $this->hasMany(CrawledData::class);
    }

    public function failedCrawls()
    {
        return $this->hasMany(FailedCrawl::class);
    }

}

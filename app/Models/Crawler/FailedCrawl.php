<?php

namespace App\Models\Crawler;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedCrawl extends Model
{
    use HasFactory;

    protected $fillable = [
        'search_id',
        'url',
        'error_message',
    ];
}

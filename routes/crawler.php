<?php

use App\Http\Controllers\CrawlerController;

Route::get('/crawler', [CrawlerController::class, 'index'])->name('dashboard.user.crawler.crawler');
Route::post('/crawler', [CrawlerController::class, 'crawl'])->name('dashboard.user.crawler.crawl');

Route::get('/crawl/results/{search}', [CrawlerController::class, 'results'])->name('crawl.results');

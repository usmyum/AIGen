<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Crawler\Search;
use App\Models\Crawler\Keyword;
use App\Models\Crawler\CrawledData;
use Illuminate\Support\Facades\Auth;
use Spatie\Crawler\Crawler;
use App\Observers\CustomCrawlObserver;

class CrawlerController extends Controller
{
    public function index()
    {
        return view('panel.user.crawler.crawler');
    }

    public function crawl(Request $request)
    {
        $url = $request->input('url');
        $keywords = explode(',', $request->input('keywords')); // Assume keywords are comma-separated
        $user = Auth::user();

        ################################################
        // move the below code into the service once experimenting done
        ################################################

        // Store the search
        $search = Search::create([
            'user_id' => $user->id,
            'url' => $url,
        ]);

        // Store the keywords and associate them with the search
        foreach ($keywords as $keyword) {
            $keyword = trim($keyword);
            $keywordModel = Keyword::firstOrCreate(['keyword' => $keyword]);
            $search->keywords()->attach($keywordModel->id);
        }

        // Perform the crawling
        Crawler::create()
            ->setCrawlObserver(new CustomCrawlObserver($search, $keywords))
            ->setTotalCrawlLimit(10)
            ->startCrawling($url);

        return redirect()->route('crawl.results', ['search' => $search->id]);
    }

    public function results(Search $search)
    {
        $crawledData = $search->crawledData;
        $failedCrawls = $search->failedCrawls; // Make sure you have a relationship defined for this
        return view('panel.user.crawler.results', compact('crawledData', 'failedCrawls'));
    }

}

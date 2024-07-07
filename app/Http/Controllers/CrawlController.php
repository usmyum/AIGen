<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search;
use App\Models\Keyword;
use App\Models\CrawledData;
use Illuminate\Support\Facades\Auth;
use Spatie\Crawler\Crawler;
use App\Observers\CustomCrawlObserver;

class CrawlController extends Controller
{
    public function index()
    {
        return view('crawl.index');
    }

    public function crawl(Request $request)
    {
        $url = $request->input('url');
        $keywords = explode(',', $request->input('keywords')); // Assume keywords are comma-separated
        $user = Auth::user();

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
            ->startCrawling($url);

        return redirect()->route('crawl.results', ['search' => $search->id]);
    }

    public function results(Search $search)
    {
        $crawledData = $search->crawledData;
        return view('crawl.results', compact('crawledData'));
    }
}


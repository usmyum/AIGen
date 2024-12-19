<?php

namespace App\Observers;

use App\Models\Crawler\CrawledData;
use App\Models\Crawler\FailedCrawl;
use App\Models\Crawler\Search;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Spatie\Crawler\CrawlObservers\CrawlObserver;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class CustomCrawlObserver extends CrawlObserver
{
    private $search;
    private $keywords;
    private $maxCrawlCount;
    private $crawledCount = 0;

    public function __construct(Search $search, array $keywords, $maxCrawlCount = 100)
    {
        $this->search = $search;
        $this->keywords = $keywords;
        $this->maxCrawlCount = $maxCrawlCount;
    }

    public function willCrawl(UriInterface $url): void
    {
        Log::info('Will crawl URL: ' . (string)$url);
    }

    public function crawled(
        UriInterface      $url,
        ResponseInterface $response,
        ?UriInterface     $foundOnUrl = null
    ): void
    {
        Log::info('Crawled URL: ' . (string)$url);
        Log::info('Response Status Code: ' . $response->getStatusCode());

        $html = (string)$response->getBody();
        $crawler = new DomCrawler($html);

        foreach ($this->keywords as $keyword) {
            $crawler->filter('body')->each(function (DomCrawler $node) use ($keyword, $url) {
                if (stripos($node->text(), $keyword) !== false) {
                    CrawledData::create([
                        'search_id' => $this->search->id,
                        'content' => substr($node->text(), 0, 255),
                        'url' => (string)$url,
                    ]);
                }
            });
        }

        $this->crawledCount++;

        if ($this->crawledCount >= $this->maxCrawlCount) {
            $this->abortCrawl();
        }
    }

    public function crawlFailed(UriInterface $url, RequestException $requestException, ?UriInterface $foundOnUrl = null): void
    {
        $errorMessage = $requestException->getMessage();
        Log::error('Crawl failed for URL: ' . (string)$url, [
            'error' => $errorMessage,
            'url' => (string)$url,
            'found_on_url' => (string)$foundOnUrl,
            'exception' => $requestException
        ]);

        FailedCrawl::create([
            'search_id' => $this->search->id,
            'url' => (string)$url,
            'error_message' => $errorMessage,
        ]);
    }

    public function finishedCrawling(): void
    {
        Log::info('Finished crawling for search ID: ' . $this->search->id);
    }

    private function abortCrawl()
    {
        Log::warning('Maximum crawl count reached. Aborting crawl.');
        throw new \Exception('Maximum crawl count reached. Aborting crawl.');
    }
}

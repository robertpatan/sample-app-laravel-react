<?php declare(strict_types=1);


namespace App\Http\Services;


use App\Helper\Util;

class FeedService
{
    /**
     * @throws Exception
     */
    public function getMovies(): iterable
    {
        $url = env('FEED_URL', null);
        
        if (!$url) {
            throw new Exception('Movie env variable FEED_URL is not configured.');
        }
        
//        $client = new Client();
//        $response = $client->get($url);
        $json = Util::cleanJsonString(file_get_contents($url));
        
        
        return collect(json_decode($json, true));
    }
}
<?php /** @noinspection ALL */


namespace App\Http\Services;


use App\Helper\Util;
use App\Http\Repository\MovieRepository;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;

class MovieService
{
    protected object $movieRepository;
    
    /**
     * MovieService constructor.
     * @param  MovieRepository  $movieRepository
     */
    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }
    
    
    public function all(): iterable
    {
    
        $testData = [
            'id'           => '13123',
            'body'         => 'asdasdas',
            'cert'         => 'asdasd',
            'class'        => '',
            'duration'     => '',
            'headline'     => '',
            'lastUpdated'  => '',
            'quote'        => '',
            'reviewAuthor' => '',
            'rating'       => 3,
            'year'         => 2012,
            'skyGoId'      => '',
            'skyGoUrl'     => '',
            'sum'          => '',
            'synopsis'     => '',
            'url'          => '',
        ];
        
        $this->movieRepository->create($testData);
        
//        dd(Redis::hscan('*movie:13123', 0));
//        dd(Redis::hgetall('movie:13123'));
        dd(Redis::command('HSCAN', [0]));
        
        $data = $this->getFeedData();
    }
    
    public function view($movieId)
    {
    
    }
    
    
    /**
     * @throws Exception
     */
    protected function getFeedData(): iterable
    {
        $url = env('FEED_URL', null);
        
        if (!$url) {
            throw new Exception('Movie env variable FEED_URL is not configured.');
        }
        
        $client = new Client();
        $response = $client->get($url);
        $json = Util::cleanJsonString($response->getBody()->getContents());
        
        
        return collect(json_decode($json, true));
    }
    
    
    
}
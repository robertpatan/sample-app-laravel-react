<?php /** @noinspection ALL */


namespace App\Http\Services;


use App\Helper\Util;
use App\Http\Repository\MovieRepository;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class MovieService
{
    protected object $movieRepository;
    protected object $feedService;
    
    /**
     * MovieService constructor.
     * @param  MovieRepository  $movieRepository
     */
    public function __construct(
        MovieRepository $movieRepository,
        FeedService $feedService
    )
    {
        $this->movieRepository = $movieRepository;
        $this->feedService = $feedService;
    }
    
    
    /**
     * @return iterable
     */
    public function list($limit = 5): iterable
    {
        return $this->movieRepository->getAll();
    }
    
    public function view($movieId)
    {
    
    }
    
    /**
     * @param  array  $movieData
     * @return mixed
     */
    public function create(array $movieData)
    {
        return $this->movieRepository->create($movieData);
    }
    
    
    
    
    
    
}
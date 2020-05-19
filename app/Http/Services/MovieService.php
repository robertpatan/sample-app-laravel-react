<?php declare(strict_types=1);

namespace App\Http\Services;

use App\Http\Repository\MovieRepository;

class MovieService
{
    protected object $movieRepository;
    protected object $feedService;
    
    /**
     * MovieService constructor.
     * @param  MovieRepository  $movieRepository
     * @param  FeedService  $feedService
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
     * @param  int  $limit
     * @return iterable
     */
    public function list($limit = 5): iterable
    {
        return $this->movieRepository->getAll();
    }
    
    /**
     * @param $movieId
     */
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
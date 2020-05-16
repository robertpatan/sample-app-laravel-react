<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Services\MovieService;

class AppController extends Controller
{
    protected object $movieService;
    
    /**
     * AppController constructor.
     *
     * @param  MovieService  $movieService
     */
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }
    
    public function index(): string
    {
        $test = '123';
        
        if ($test === '123') {
            return $test;
        }
        
        return 'asd';
    }
    
    public function test()
    {
    
        
        $movies = $this->movieService->list();
        
        dd($movies);
        
//        dd(Redis::hmget('user:1', ['id', 'body']));
//        $keyId = $this->movieRepository->generateKeyId();
        
//        $movie = $this->movieRepository->create($keyId, $testData);
    
//        dump($movie);
        
//        dd($movie->attributes());
    }
}

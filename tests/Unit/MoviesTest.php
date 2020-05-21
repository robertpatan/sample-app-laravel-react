<?php

namespace Tests\Unit;

use App\Http\Services\FeedService;
use App\Http\Services\MovieService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;

class MoviesTest extends \Tests\TestCase
{
    use DatabaseMigrations;
    //    use RefreshDatabase;
    
    protected FeedService $feedService;
    protected MovieService $movieService;
    protected Collection $movieList;
    
    public function setUp(): void
    {
        parent::setUp();
        
        $this->movieService = app(MovieService::class);
        $this->feedService = app(FeedService::class);
        $this->movieList = $this->feedService->getMovies();
        
        $this->runDatabaseMigrations();
    }
    
    
    public function testInsertSingleMovie(): void
    {
        $response = $this->createMovie();
        
        $this->assertIsInt($response->id);
    }
    
    public function testApiGetMovieList(): void
    {
        $response = $this->get('/api/movies');
        $response->assertStatus(200);
    }
    
    public function testApiGetMovieDetails(): void
    {
        $movie = $this->createMovie();
        
        $response = $this->get('/api/movies/'.$movie->id);
        $response->assertStatus(200);
    }
    
    public function createMovie()
    {
        $movieData = $this->movieList->first();
        return $this->movieService->create((array) $movieData);
    }
    
}

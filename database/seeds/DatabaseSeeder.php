<?php

use Illuminate\Database\Seeder;
use App\Http\Services\FeedService;
use App\Http\Services\MovieService;

class DatabaseSeeder extends Seeder
{
    protected object $feedService;
    protected object $movieService;
    
    public function __construct(
        FeedService $feedService,
        MovieService $movieService
    ) {
        $this->feedService = $feedService;
        $this->movieService = $movieService;
    }
    
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $movieCollection = $this->feedService->getMovies();
        
        foreach ($movieCollection as $movieData) {
            
            $movie = $this->movieService->create($movieData);
            
            dump('Movie with id: '.$movieData['id'].'seeded');
            
        }
        
        // $this->call(UserSeeder::class);
    }
}

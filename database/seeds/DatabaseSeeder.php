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
            
            DB::transaction(function () use ($movieData) {
                
                $movie = $this->movieService->insertIfNotExists($movieData);
                
                if (!empty($movieData['cardImages'])) {
                    foreach ($movieData['cardImages'] as $cardImage) {
                        $this->movieService->attachCardImage($movie, $cardImage);
                    }
                }
                
                if (!empty($movieData['keyArtImages'])) {
                    foreach ($movieData['keyArtImages'] as $artImage) {
                        $this->movieService->attachKeyArtImage($movie, $artImage);
                    }
                }
                
                if (!empty($movieData['cast'])) {
                    foreach ($movieData['cast'] as $person) {
                        $this->movieService->attachCast($movie, $person);
                    }
                }
                
                if (!empty($movieData['directors'])) {
                    foreach ($movieData['directors'] as $director) {
                        $this->movieService->attachDirector($movie, $director);
                    }
                }
                
                if (!empty($movieData['videos'])) {
                    foreach ($movieData['videos'] as $video) {
                        $this->movieService->attachVideo($movie, $video);
                    }
                }
                
                if (!empty($movieData['viewingWindow'])) {
                    $this->movieService->attachViewingWindow($movie, $movieData['viewingWindow']);
                }
    
                if (!empty($movieData['reviewAuthor'])) {
                    $this->movieService->attachReviewAuthor($movie, ['name' => $movieData['reviewAuthor']]);
                }
    
                if (!empty($movieData['genres'])) {
                    foreach ($movieData['genres'] as $name) {
                        $this->movieService->attachGenre($movie, ['name' => $name]);
                    }
                }
                
            });
        }
        
        // $this->call(UserSeeder::class);
    }
    
    
}

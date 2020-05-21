<?php

namespace Tests\Unit;

use App\Http\Services\FeedService;
use PHPUnit\Framework\TestCase;

class FeedServiceTest extends TestCase
{
    protected FeedService $feedService;
    
    public function setUp(): void
    {
        parent::setUp();
        
        $this->feedService = new FeedService();
    }
    
   
    
    public function testReceiveAtLeastOneMovieItemFromFeed(): void
    {
        $result  = $this->feedService->getMovies();
        
        $this->assertTrue($result->count() > 0);
    }
}

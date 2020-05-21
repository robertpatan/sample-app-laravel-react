<?php declare(strict_types=1);

namespace App\Http\Services;

use App\Http\Helper\Util;
use App\Http\Models\Movie;
use App\Http\Repository\AlternativeVideoRepository;
use App\Http\Repository\GenreRepository;
use App\Http\Repository\ImageRepository;
use App\Http\Repository\MovieRepository;
use App\Http\Repository\MovieViewingWindowRepository;
use App\Http\Repository\PersonRepository;
use App\Http\Repository\VideoRepository;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MovieService
{
    protected FeedService $feedService;
    
    protected MovieRepository $movieRepository;
    protected ImageRepository $imageRepository;
    protected PersonRepository $personRepository;
    protected GenreRepository $genreRepository;
    protected VideoRepository $videoRepository;
    protected AlternativeVideoRepository $alternativeVideoRepository;
    protected MovieViewingWindowRepository $movieViewingWindowRepository;
    
    /**
     * MovieService constructor
     *
     * @param  MovieRepository  $movieRepository
     * @param  FeedService  $feedService
     * @param  ImageRepository  $imageRepository
     * @param  PersonRepository  $personRepository
     * @param  GenreRepository  $genreRepository
     * @param  VideoRepository  $videoRepository
     * @param  AlternativeVideoRepository  $alternativeVideoRepository
     * @param  MovieViewingWindowRepository  $movieViewingWindowRepository
     */
    public function __construct(
        MovieRepository $movieRepository,
        FeedService $feedService,
        ImageRepository $imageRepository,
        PersonRepository $personRepository,
        GenreRepository $genreRepository,
        VideoRepository $videoRepository,
        AlternativeVideoRepository $alternativeVideoRepository,
        MovieViewingWindowRepository $movieViewingWindowRepository
    ) {
        $this->movieRepository = $movieRepository;
        $this->feedService = $feedService;
        $this->imageRepository = $imageRepository;
        $this->personRepository = $personRepository;
        $this->genreRepository = $genreRepository;
        $this->videoRepository = $videoRepository;
        $this->alternativeVideoRepository = $alternativeVideoRepository;
        $this->movieViewingWindowRepository = $movieViewingWindowRepository;
    }
    
    
    /**
     * @param  int  $limit
     * @return iterable
     */
    public function list($limit = 5): iterable
    {
        $maxLength = 250;
        $movies = $this->movieRepository->getAll();
        $movies->map(function ($item) use ($maxLength) {
            if ($item->body) {
                $item->body = Util::createPreviewDescription($item->body, $maxLength);
            }
            
            return $item;
        });
        
        return $movies;
    }
    
    /**
     *
     *
     * @param $movieId
     * @return Movie
     */
    public function getMovieById($movieId): Movie
    {
        $movie = $this->movieRepository->findById($movieId);
        $movie->body = Util::htmlEncodeNewLines($movie->body);
        
        return $movie;
    }
    
    /**
     * @param  array  $movieData
     * @return mixed
     */
    public function create(array $movieData)
    {
        return $this->movieRepository->insert($movieData);
    }
    
    /**
     * @param  array  $data
     * @return mixed
     */
    public function insertIfNotExists(array $data): Model
    {
        $movie = $this->movieRepository->findByUid($data['id']);
        
        if (!$movie) {
            return $this->movieRepository->insert($data);
        }
        
        return $movie;
    }
    
    /**
     * @param  Movie  $movie
     * @param  array  $data
     * @return void
     */
    public function attachCardImage(Movie $movie, array $data): void
    {
        $filePath = $this->storeCacheFile($data['url']);
        
        if ($filePath) {
            $data['cache_storage_path'] = $filePath;
            $image = $this->imageRepository->insert($data);
            
            $movie->cardImages()->attach($image->id);
        }
    }
    
    /**
     * @param  Movie  $movie
     * @param  array  $data
     * @return void
     */
    public function attachKeyArtImage(Movie $movie, array $data): void
    {
        $filePath = $this->storeCacheFile($data['url']);
        
        if ($filePath) {
            $data['cache_storage_path'] = $filePath;
            $image = $this->imageRepository->insert($data);
            
            $movie->keyArtImages()->attach($image->id);
        }
    }
    
    /**
     * @param  Movie  $movie
     * @param  array  $data
     * @return void
     */
    public function attachDirector(Movie $movie, array $data): void
    {
        $person = $this->personRepository->insertIfNotExists($data);
        
        $movie->directors()->attach($person->id);
    }
    
    /**
     * @param  Movie  $movie
     * @param  array  $data
     * @return void
     */
    public function attachCast(Movie $movie, array $data): void
    {
        $person = $this->personRepository->insertIfNotExists($data);
        
        $movie->cast()->attach($person->id);
    }
    
    /**
     * @param  Movie  $movie
     * @param  array  $data
     * @return void
     */
    public function attachGenre(Movie $movie, array $data): void
    {
        $genre = $this->genreRepository->insertIfNotExists($data);
        
        $movie->genres()->attach($genre->id);
    }
    
    /**
     * @param  Movie  $movie
     * @param  array  $data
     * @return void
     */
    public function attachVideo(Movie $movie, array $data): void
    {
        $filePath = $this->storeCacheFile($data['url']);
        
        if ($filePath) {
            $data['cache_storage_path'] = $filePath;
            $video = $this->videoRepository->insert($data);
            
            if (!empty($data['alternatives'])) {
                foreach ($data['alternatives'] as $altData) {
                    $videoFilePath = $this->storeCacheFile($data['url']);
                    
                    if ($videoFilePath) {
                        $altData['cache_storage_path'] = $filePath;
                        $altVideo = $this->alternativeVideoRepository->create($altData);
                        $video->alternatives()->save($altVideo);
                    }
                }
            }
            
            
            $movie->videos()->attach($video->id);
        }
    }
    
    /**
     * @param  Movie  $movie
     * @param  array  $data
     * @return void
     */
    public function attachViewingWindow(Movie $movie, array $data): void
    {
        $movie->viewingWindow()->save($this->movieViewingWindowRepository->create($data));
    }
    
    /**
     * @param  Movie  $movie
     * @param  array  $data
     * @return void
     */
    public function attachReviewAuthor(Movie $movie, array $data): void
    {
        $person = $this->personRepository->insertIfNotExists($data);
        $movie->review_author_id = $person->id;
        $movie->save();
    }
    
    /**
     *
     * @param $url
     * @return bool|string
     */
    protected function storeCacheFile($url)
    {
        $client = new Client();
        
        try {
            $response = $client->get($url);
            
            if ($response->getStatusCode() === 200) {
                $storage = Storage::disk('cache');
                $fileName = Util::generateUid();
                $storage->put($fileName, $response->getBody()->getContents());
                
                return $fileName;
            }
        } catch (\Exception $e) {
            \Log::error('Resource is not available: ' . $url);
        }
        
        return null;
    }
}

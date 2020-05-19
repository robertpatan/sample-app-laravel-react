<?php declare(strict_types=1);

namespace App\Http\Services;

use App\Http\Models\Movie;
use App\Http\Repository\GenreRepository;
use App\Http\Repository\ImageRepository;
use App\Http\Repository\MovieRepository;
use App\Http\Repository\MovieViewingWindowRepository;
use App\Http\Repository\PersonRepository;
use App\Http\Repository\VideoRepository;
use Illuminate\Database\Eloquent\Model;

class MovieService
{
    protected FeedService $feedService;
    
    protected MovieRepository $movieRepository;
    protected ImageRepository $imageRepository;
    protected PersonRepository $personRepository;
    protected GenreRepository $genreRepository;
    protected VideoRepository $videoRepository;
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
     * @param  MovieViewingWindowRepository  $movieViewingWindowRepository
     */
    public function __construct(
        MovieRepository $movieRepository,
        FeedService $feedService,
        ImageRepository $imageRepository,
        PersonRepository $personRepository,
        GenreRepository $genreRepository,
        VideoRepository $videoRepository,
        MovieViewingWindowRepository $movieViewingWindowRepository
    ) {
        $this->movieRepository = $movieRepository;
        $this->feedService = $feedService;
        $this->imageRepository = $imageRepository;
        $this->personRepository = $personRepository;
        $this->genreRepository = $genreRepository;
        $this->videoRepository = $videoRepository;
        $this->movieViewingWindowRepository = $movieViewingWindowRepository;
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
     * @param  Movie  $model
     * @param  array  $data
     * @return void
     */
    public function attachCardImage(Movie $model, array $data): void
    {
        $image = $this->imageRepository->insert($data);
        
        $model->cardImages()->attach($image->id);
    }
    
    /**
     * @param  Movie  $model
     * @param  array  $data
     * @return void
     */
    public function attachKeyArtImage(Movie $model, array $data): void
    {
        $image = $this->imageRepository->insert($data);
        
        $model->keyArtImages()->attach($image->id);
    }
    
    /**
     * @param  Movie  $model
     * @param  array  $data
     * @return void
     */
    public function attachDirector(Movie $model, array $data): void
    {
        $person = $this->personRepository->insertIfNotExists($data);
        
        $model->directors()->attach($person->id);
    }
    
    /**
     * @param  Movie  $model
     * @param  array  $data
     * @return void
     */
    public function attachCast(Movie $model, array $data): void
    {
        $person = $this->personRepository->insertIfNotExists($data);
        
        $model->cast()->attach($person->id);
    }
    
    /**
     * @param  Movie  $model
     * @param  array  $data
     * @return void
     */
    public function attachGenre(Movie $model, array $data): void
    {
        $genre = $this->genreRepository->insertIfNotExists($data);
        
        $model->genres()->attach($genre->id);
    }
    
    /**
     * @param  Movie  $model
     * @param  array  $data
     * @return void
     */
    public function attachVideo(Movie $model, array $data): void
    {
        $video = $this->videoRepository->insertWithRelation($data);
        
        $model->videos()->attach($video->id);
    }
    
    /**
     * @param  Movie  $model
     * @param  array  $data
     * @return void
     */
    public function attachViewingWindow(Movie $model, array $data): void
    {
        $model->viewingWindow()->save($this->movieViewingWindowRepository->create($data));
    }
    
    /**
     * @param  Movie  $model
     * @param  array  $data
     * @return void
     */
    public function attachReviewAuthor(Movie $model, array $data): void
    {
        $person = $this->personRepository->insertIfNotExists($data);
        $model->review_author_id = $person->id;
        $model->save();
    }
}
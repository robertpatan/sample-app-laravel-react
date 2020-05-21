<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Helper\Util;
use App\Http\Services\MovieService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AppController extends Controller
{
    public const CACHE_EXPIRE_MINUTES = 60;
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
    
    /**
     *
     * @return mixed
     */
    public function getMovies()
    {
        return Cache::remember('movies', self::CACHE_EXPIRE_MINUTES, function () {
            return $this->movieService->list();
        });
    }
    
    /**
     *
     * @param $id
     * @return mixed
     */
    public function getMovie($id)
    {
        return Cache::remember('movie_' . $id, self::CACHE_EXPIRE_MINUTES, function () use($id) {
            return $this->movieService->getMovieById($id);
        });
    }
    
    
    /**
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getCacheAsset(Request $request): \Illuminate\Http\Response
    {
        $storage = \Storage::disk('cache');
        $path = base64_decode($request->path);
        
        if ($storage->exists($path)) {
            $image = $storage->get($path);
            $mimeType = $storage->mimeType($path);
        } else {
            $placeHolderPath = public_path(env('NO_IMAGE_PLACEHOLDER_PATH'));
            $image = file_get_contents($placeHolderPath);
            $mimeType = mime_content_type($placeHolderPath);
        }
        
        return response()->make($image, 200, ['Content-type' => $mimeType]);
    }
}

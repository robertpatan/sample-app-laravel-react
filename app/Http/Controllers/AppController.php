<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Helper\Util;
use App\Http\Services\MovieService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
    
    /**
     *
     * @return mixed
     */
    public function getMovies()
    {
        $expireInMinutes = 60;
        
        return Cache::remember('movies', $expireInMinutes, function () {
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
        return $this->movieService->getMovieById($id);
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
    
    /**
     * @param  Request  $request
     * @return mixed
     */
    public function getAsset(Request $request)
    {
        $expireInMinutes = 60;
        $decodedUrl = urldecode($request->url);
        
        $imageCacheKey = 'image_'.$request->url;
        $imageMimeCacheKey = 'image_mime_'.$request->url;
        
        try {
            $fileContent = file_get_contents($decodedUrl);
            $image = Cache::remember($imageCacheKey, $expireInMinutes, function () use ($fileContent) {
                return $fileContent;
            });
            
            $mimeType = Cache::remember($imageMimeCacheKey, $expireInMinutes, function () use ($fileContent) {
                return Util::getMimeTypeFromContent($fileContent);
            });
        } catch (\Exception $e) {
            \Log::warning('Could  not get image from: '.$decodedUrl);
            $image = file_get_contents(public_path(env('NO_IMAGE_PLACEHOLDER_PATH')));
            $mimeType = Util::getMimeTypeFromContent($image);
        }
        
        
        return response()->make($image, 200, ['Content-type' => $mimeType]);
    }
    
    
}

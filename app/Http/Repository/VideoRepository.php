<?php declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Models\Video;
use App\Http\Models\AlternativeVideo;

class VideoRepository extends Repository
{
    private AlternativeVideoRepository $alternativeVideoRepository;
    
    /**
     * ImageRepository constructor.
     *
     * @param  Video  $video
     * @param  AlternativeVideoRepository  $alternativeVideoRepository
     */
    public function __construct(
        Video $video,
        AlternativeVideoRepository $alternativeVideoRepository
    ) {
        $this->model = $video;
        $this->alternativeVideoRepository = $alternativeVideoRepository;
    }
    
    /**
     * @param  array  $videoData
     * @return mixed
     */
    public function insert(array $videoData)
    {
        $video = new  $this->model();
        $video->title = $videoData['title'];
        $video->type = $videoData['type'];
        $video->original_url = $videoData['url'];
        $video->cache_storage_path = $videoData['cache_storage_path'];
        $video->save();
        
        return $video;
    }
    
}
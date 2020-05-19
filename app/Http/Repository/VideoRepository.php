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
    public function insertWithRelation(array $videoData)
    {
        $video = new  $this->model();
        $video->title = $videoData['title'];
        $video->type = $videoData['type'];
        $video->url = $videoData['url'];
        $video->save();
        
        if(!empty($videoData['alternatives'])) {
            foreach($videoData['alternatives'] as $altData) {
                $altVideo = $this->alternativeVideoRepository->create($altData);
                $video->alternatives()->save($altVideo);
            }
        }
        
        return $video;
    }
    
}
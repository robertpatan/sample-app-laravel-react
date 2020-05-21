<?php declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Models\AlternativeVideo;

class AlternativeVideoRepository extends Repository
{
    
    /**
     * AlternativeVideoRepository constructor.
     *
     * @param  AlternativeVideo  $videoAlternative
     */
    public function __construct(
        AlternativeVideo $videoAlternative
    ) {
        $this->model = $videoAlternative;
    }
    
    /**
     * Creates a new AlternativeVideo instance
     *
     * @param  array  $alternativeVideo
     * @return AlternativeVideo
     */
    public function create(array $alternativeVideo): AlternativeVideo
    {
        $entry = new  $this->model();
        $entry->quality = $alternativeVideo['quality'];
        $entry->original_url = $alternativeVideo['url'];
        $entry->cache_storage_path = $alternativeVideo['cache_storage_path'];
        
        return $entry;
    }
    
    /**
     * Inserts a new resource
     *
     * @param  array  $alternativeVideo
     * @return AlternativeVideo
     */
    public function insert(array $alternativeVideo): AlternativeVideo
    {
        $entry = new  $this->model();
        $entry->quality = $alternativeVideo['quality'];
        $entry->url = $alternativeVideo['url'];
        $entry->save();
        
        return $entry;
    }
}

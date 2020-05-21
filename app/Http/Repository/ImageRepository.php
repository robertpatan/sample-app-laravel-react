<?php declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Models\Image;

class ImageRepository extends Repository
{
    /**
     * ImageRepository constructor.
     *
     * @param  Image  $image
     */
    public function __construct(
        Image $image
    ) {
        $this->model = $image;
    }
    
    /**
     * Creates a new model instance
     *
     * @param  array  $imageData
     * @return Image
     */
    public function create(array $imageData): Image
    {
        $entry = new  $this->model();
        $entry->url = $imageData['url'];
        $entry->height = $imageData['h'] ?? null;
        $entry->width = $imageData['w'] ?? null;
        
        return $entry;
    }
    
    /**
     * @param  array  $imageData
     * @return Image
     */
    public function insert(array $imageData): Image
    {
        $entry = new  $this->model();
        $entry->original_url = $imageData['url'];
        $entry->cache_storage_path = $imageData['cache_storage_path'];
        $entry->height = $imageData['h'] ?? null;
        $entry->width = $imageData['w'] ?? null;
        $entry->save();
        
        return $entry;
    }
    
}
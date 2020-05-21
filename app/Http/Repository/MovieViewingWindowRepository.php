<?php declare(strict_types=1);


namespace App\Http\Repository;

use App\Http\Models\MovieViewingWindow;

class MovieViewingWindowRepository extends Repository
{
    /**
     * ImageRepository constructor.
     *
     * @param  MovieViewingWindow  $movieViewingWindow
     */
    public function __construct(
        MovieViewingWindow  $movieViewingWindow
    ) {
        $this->model = $movieViewingWindow;
    }
    
    /**
     * Creates a new model instance
     *
     * @param  array  $data
     * @return MovieViewingWindow
     */
    public function create(array $data): MovieViewingWindow
    {
        $entry = new  $this->model();
        $entry->start_at = $data['startDate'] ?? null;
        $entry->end_at = $data['endDate'] ?? null;
        $entry->way_to_watch = $data['wayToWatch'] ?? null;
        
        return $entry;
    }
}

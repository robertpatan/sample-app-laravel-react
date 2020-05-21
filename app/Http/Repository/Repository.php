<?php declare(strict_types=1);


namespace App\Http\Repository;

class Repository
{
    protected object $model;
    
    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->with('keyArtImages')->get();
    }
    
    public function findById($id)
    {
        return $this->model
            ->with(
                'reviewAuthor',
                'keyArtImages',
                'videos.alternatives',
                'cardImages',
                'viewingWindow',
                'cast',
                'directors',
                'genres'
            )
            ->find($id);
    }
    
    /**
     * @param $modelData
     * @return mixed
     */
    public function create(array $modelData)
    {
        return $this->model->create($modelData);
    }
}

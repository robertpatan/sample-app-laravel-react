<?php declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Models\Genre;

class GenreRepository extends Repository
{
    /**
     * GenreRepository constructor.
     *
     * @param  Genre  $genre
     */
    public function __construct(
        Genre $genre
    ) {
        $this->model = $genre;
    }
    
    /**
     * Inserts a new resource if not exists or returns the existing one
     *
     * @param  array  $data
     * @return Genre
     */
    public function insertIfNotExists(array $data): Genre
    {
        $genre = $this->findByName($data['name']);
        
        if(!$genre) {
            $genre = new  $this->model();
            $genre->name = $data['name'];
            $genre->save();
        }
        
        return $genre;
    }
    
    /**
     * Retrieves first row by the given name
     *
     * @param $name
     * @return mixed
     */
    public function findByName($name)
    {
        return $this->model->where('name', $name)->first();
    }
    
}
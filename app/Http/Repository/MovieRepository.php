<?php


namespace App\Http\Repository;


use App\Http\Entity\MovieEntity;
use Exception;
use GuzzleHttp\Client;

class MovieRepository extends AbstractRepository
{
    /**
     * MovieRepository constructor.
     *
     * @param  MovieEntity  $movieEntity
     */
    public function __construct(
        MovieEntity $movieEntity
    ) {
        $this->entity = $movieEntity;
    }
    
}
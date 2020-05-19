<?php declare(strict_types=1);


namespace App\Http\Repository;


use App\Http\Models\Movie;

class MovieRepository extends Repository
{
    /**
     * MovieRepository constructor.
     *
     * @param  Movie  $movie
     */
    public function __construct(
        Movie $movie
    ) {
        $this->model = $movie;
    }
    
    /**
     * @param $uid
     * @return mixed
     */
    public function findByUid($uid)
    {
        return $this->model->where('uid', $uid)->first();
    }
    
    /**
     * @param $movieData
     * @return mixed
     */
    public function insert($movieData)
    {
        $model = new $this->model();
        $model->uid = $movieData['id'];
        $model->body = $movieData['body'];
        $model->cert = $movieData['cert'];
        $model->class = $movieData['class'];
        $model->duration = $movieData['duration'];
        $model->headline = $movieData['headline'];
        $model->quote = $movieData['quote'] ?? null;
        $model->review_author_id = $movieData['reviewAuthorId'] ?? null;
        $model->rating = $movieData['rating'] ?? 0;
        $model->year = $movieData['year'];
        $model->sky_go_id = $movieData['skyGoId'] ?? null;
        $model->sky_go_url = $movieData['skyGoUrl'] ?? null;
        $model->sum = $movieData['sum'];
        $model->synopsis = $movieData['synopsis'];
        $model->url = $movieData['url'];
        $model->updated_at = $movieData['lastUpdated'];
        $model->save();
    
        return $model;
    }
    
    
    
}
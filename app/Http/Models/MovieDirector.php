<?php declare(strict_types=1);


namespace App\Http\Models;


use Jenssegers\Mongodb\Eloquent\Model;

class MovieDirector extends Model
{
    protected $fillable = [
        'movie_id',
        'person_id'
    ];
}
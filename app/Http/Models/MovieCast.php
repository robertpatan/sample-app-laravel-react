<?php declare(strict_types=1);

namespace App\Http\Models;

class MovieCast extends AbstractPersonModel
{
    protected $table = 'movie_casts';
    
    protected $fillable = [
        'movie_id',
        'person_id'
    ];
}
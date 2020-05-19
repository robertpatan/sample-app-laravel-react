<?php declare(strict_types=1);

namespace App\Http\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class MovieGenre extends Model {
    protected $fillable = [
        'movie_id',
        'genre_id'
    ];

}
<?php declare(strict_types=1);

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class MovieGenre extends Model {
    protected $fillable = [
        'movie_id',
        'genre_id'
    ];

}
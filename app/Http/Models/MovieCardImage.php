<?php declare(strict_types=1);

namespace App\Http\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class MovieCardImage extends Model
{
    protected $fillable = [
        'movie_id',
        'image_id'
    ];
}
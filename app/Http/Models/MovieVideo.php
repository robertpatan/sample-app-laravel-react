<?php declare(strict_types=1);

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class MovieVideo extends Model {
    
    protected $fillable = [
        'movie_id',
        'video_id'
    ];

}
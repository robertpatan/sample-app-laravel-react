<?php declare(strict_types=1);

namespace App\Http\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Movie extends Model
{
    
    protected $fillable = [
        'uid',
        'body',
        'cert',
        'class',
        'duration',
        'headline',
        'lastUpdated',
        'quote',
        'reviewAuthor',
        'rating',
        'year',
        'skyGoId',
        'skyGoUrl',
        'sum',
        'synopsis',
        'url',
    ];
    
}
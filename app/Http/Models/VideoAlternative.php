<?php declare(strict_types=1);

namespace App\Http\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class VideoAlternative extends Model {
    
    protected $fillable = [
        'url',
        'quality'
    ];

}
<?php declare(strict_types=1);

namespace App\Http\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Video extends Model {
    protected $fillable = [
        'title',
        'type',
        'url'
    ];
}
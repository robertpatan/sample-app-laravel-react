<?php declare(strict_types=1);

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'original_url',
        'height',
        'width',
        'cache_storage_path'
    ];
    
//    public function movies() {
//        return $this->belongsToMany(Movie::class)->using(CardImageMovie::class);
//    }
}

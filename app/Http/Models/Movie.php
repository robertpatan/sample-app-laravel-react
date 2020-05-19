<?php declare(strict_types=1);

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

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
    
    /**
     * @return HasOne
     */
    public function viewingWindow(): HasOne
    {
        return $this->hasOne(MovieViewingWindow::class);
    }
    
    /**
     * @return HasManyThrough
     */
    public function cardImages(): HasManyThrough
    {
        return $this->hasManyThrough(Image::class, MovieCardImage::class);
    }
    
    /**
     * @return HasManyThrough
     */
    public function keyArtImages(): HasManyThrough
    {
        return $this->hasManyThrough(Image::class, MovieArtImage::class);
    }
    
    /**
     * @return HasManyThrough
     */
    public function directors(): HasManyThrough
    {
        return $this->hasManyThrough(Person::class, MovieDirector::class);
    }
    
    /**
     * @return HasManyThrough
     */
    public function cast(): HasManyThrough
    {
        return $this->hasManyThrough(Person::class, MovieCast::class);
    }
    
    /**
     * @return HasManyThrough
     */
    public function genres(): HasManyThrough
    {
        return $this->hasManyThrough(Person::class, MovieGenre::class);
    }
}
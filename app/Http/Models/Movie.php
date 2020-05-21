<?php declare(strict_types=1);

namespace App\Http\Models;

use App\Http\Models\Pivot\ArtImageMovie;
use App\Http\Models\Pivot\CardImageMovie;
use App\Http\Models\Pivot\CastMovie;
use App\Http\Models\Pivot\DirectorMovie;
use App\Http\Models\Pivot\GenreMovie;
use App\Http\Models\Pivot\MovieVideo;
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
        'quote',
        'review_author_id',
        'rating',
        'year',
        'sky_go_id',
        'sky_go_url',
        'sum',
        'synopsis',
        'url',
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reviewAuthor(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Person::class, 'id', 'review_author_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function viewingWindow(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(MovieViewingWindow::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cardImages(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'card_image_movie')->using(CardImageMovie::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function keyArtImages(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'art_image_movie')->using(ArtImageMovie::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function directors(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'director_movie')->using(DirectorMovie::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cast(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Person::class, 'cast_movie')->using(CastMovie::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_movie')->using(GenreMovie::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function videos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Video::class, 'movie_video')->using(MovieVideo::class);
    }
}

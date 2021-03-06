<?php declare(strict_types=1);

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'type',
        'url'
    ];
    
    public function alternatives()
    {
        return $this->hasMany(AlternativeVideo::class);
    }
}

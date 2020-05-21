<?php declare(strict_types=1);

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class AlternativeVideo extends Model
{
    protected $fillable = [
        'url',
        'quality'
    ];
}

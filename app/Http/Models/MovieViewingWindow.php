<?php declare(strict_types=1);

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class MovieViewingWindow extends Model
{
    
    protected $fillable = [
        'start_date',
        'way_to_watch',
        'end_date',
    ];
    
}
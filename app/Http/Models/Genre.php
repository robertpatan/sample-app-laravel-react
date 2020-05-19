<?php declare(strict_types=1);

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class Genre extends Model {
    
    protected $fillable = [
        'name',
    ];
}
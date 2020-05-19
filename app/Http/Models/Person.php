<?php declare(strict_types=1);

namespace App\Http\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Person extends Model
{
    
    protected $fillable = [
        'name',
    ];
}
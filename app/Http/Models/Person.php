<?php declare(strict_types=1);

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    
    protected $fillable = [
        'name',
    ];
}
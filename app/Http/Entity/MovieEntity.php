<?php declare(strict_types=1);

namespace App\Http\Entity;

class MovieEntity extends AbstractRedisEntity
{
    protected string $table = 'movie';

    public string $id;
    public string $body;
    public string $cert;
    public string $class;
    public string $duration;
    public string $headline;
    public string $lastUpdated;
    public ?string $quote;
    public ?string $reviewAuthor;
    public ?int $rating;
    public int $year;
    public ?string $skyGoId;
    public ?string $skyGoUrl;
    public string $sum;
    public ?string $synopsis;
    public string $url;
    
    
    /**
     * @var array of strings
     */
//    public array $genres;
//
//
//    public object $viewingWindow;
//
//    public array $videos;
//    public array $keyArtImages;
//    public array $cast;
//    public array $cardImages;
    
}
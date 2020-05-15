<?php


namespace App\Http\Entity;


/**
 * Class ViewingWindow
 * @package App\Http\AbstractRedisEntity
 */
class ViewingWindow extends \Entity
{
    public string $startDate;
    public string $wayToWatch;
    public string $endDate;
}


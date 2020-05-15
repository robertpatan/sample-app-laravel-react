<?php


namespace App\Helper;


use Exception;

class Util
{
    /**
     * Removes new lines and BOM from a string resource
     *
     * @param  string  $jsonString
     * @return string|string[]|null
     */
    public static function cleanJsonString(string $jsonString)
    {
        return preg_replace('/[\x00-\x1F\x80-\xFF]|\r\n|\r|\n/', '', $jsonString);
    }
    
    /**
     * Generates a unique 16 char hash
     *
     * @return string
     * @throws Exception
     */
    public static function generateUid(): string
    {
        return bin2hex(random_bytes(16));
    }
    
}
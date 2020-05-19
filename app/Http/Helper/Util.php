<?php


namespace App\Http\Helper;


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
    
    /**
     * @param $string
     * @return string|string[]
     */
    public static function cleanChars($string)
    {
        // Put the special chars and corresponding html entities
        $specialCharacters = array(
            'ã' => '&#x103;',
            'ă' => '&#x103;',
            'Ă' => '&#x102;',
            'â' => '&#226;',
            'Â' => '&#194;',
            'î' => '&#238;',
            'Î' => '&#206;',
            'ș' => '&#x219;',
            'Ș' => '&#x219;',
            'ş' => '&#x219;',
            'Ş' => '&#x219;',
            'ț' => '&#x163;',
            'Ț' => '&#x162;',
            'ţ' => '&#x163;',
            'Ţ' => '&#x162;',
        );
    
        foreach ($specialCharacters as $character => $replacement) {
            $string = str_replace($character, $replacement, $string);
        }
        return $string;
    }
    
    /**
     * @param $text
     * @return string|string[]
     */
    public static function replaceSymbols ($text) {
        return str_replace([
            'Ã£', 'Ã¾', ' º', 'Ã¢', 'Ã®', 'ÃŽ', 'Ã„Æ’', 'Ã… £', 'Ãƒ ®', 'Ãƒ ¢', 'ÃƒÅ½', 'Ã…Å¸', 'Ã…Å¾', 'Ã… ¢', 'Äƒ',
            'Å£', 'Ã®', 'Ã¢', 'ÃŽ', 'ÅŸ', 'Åž', 'Å¢', 'Ã‚', 'Äƒ', 'È›', 'Ã®', 'Ã¢', 'ÃŽ', 'È™', 'È˜', 'Èš', 'Ã‚', 'â„¢',
            ' ®', ' ©', 'â„—', 'â„ ', ' §', '°', '&'
        ], [
            'a', 't', 's', 'a', 'i', 'I', 'a', 't', 'i', 'a', 'I', 's', 'S', 'T', 'a', 't', 'i', 'a', 'I', 's', 'S',
            'T', 'A', 'a', 't', 'i', 'a', 'I', 's', 'S', 'T', 'A', '', '', '', '', '', '', '&deg;', '&amp;'
        ], $text);
    }
    
}
<?php

namespace Ocd\NewsBundle\Helper;

class StringSanitizer
{
    /**
     * sanitize a string
     * @param string $string
     * @return string $slug
     */
    public static function sanitize(string $string): string
    {
        $safe_string = trim(strip_tags($string));
        return $safe_string;
    }
    /**
     * lowerize a string
     * @param string $string
     * @return string $slug
     */
    public static function lowerize(string $string): string
    {
        $lower_string = mb_strtolower($string, 'UTF-8');
        return $lower_string;
    }
    /**
     * Create a slug from a string
     * @param string $string
     * @return string $slug
     */
    public static function slugify(string $string): string
    {
        $safe_string = self::sanitize($string);
        $lower_string = self::lowerize($safe_string);
        $slug = preg_replace('/\s+/', '-', $lower_string);
        return $slug;
    }
}

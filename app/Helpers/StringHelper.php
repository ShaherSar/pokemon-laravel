<?php

namespace App\Helpers;

class StringHelper{
    public static function stringToKey($string) : string {
        return trim(str_replace(" ", "_", $string));
    }
}
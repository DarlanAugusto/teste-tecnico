<?php

namespace App\Utils;

class Number {

    public static function strToFloat($str, $removeDot = true): float
    {
        if($removeDot) {
            $str = str_replace('.', '', $str);
        }
        $str = str_replace(',', '.', $str);

        return floatval($str);
    }
}
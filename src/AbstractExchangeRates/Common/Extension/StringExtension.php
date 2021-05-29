<?php

namespace Abstractapi\ExchangeRates\Common\Extension;

class StringExtension
{
    /**
     * Function for basic field validation (present and neither empty nor only white space
     *
     * @return bool
     */
    public static function isNullOrEmpty($str){
        return (!isset($str) || trim($str) === '');
    }

    /**
     * The characters to find at the beginning of this line.
     *
     * @return bool
     */
    public static function startsWith($str, $searchString){
        return substr($str, 0, strlen($searchString)) === $searchString;
    }
}

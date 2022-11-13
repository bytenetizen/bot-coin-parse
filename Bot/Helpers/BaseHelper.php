<?php

namespace Bot\Helpers;

class BaseHelper
{

    public static function getNameClass(string $class)
    {
        $array = explode('\\', $class);
        return $array[count($array) - 1];
    }

}

<?php

namespace Acme;

class StaticZero
{

    public static $counter = 0;

    public static function incrByTwo()
    {
        self::$counter = self::$counter + 2;
    }
}
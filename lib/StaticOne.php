<?php

namespace Acme;

class StaticOne extends StaticZero
{

    public static function incrByOne()
    {
        self::$counter = self::$counter + 1;
    }

    public static function incrByTwo()
    {
        parent::incrByTwo();
    }
}

<?php

namespace Acme;

class StaticOne extends StaticZero
{
    public static function incrByOne(): void
    {
        self::$counter = self::$counter + 1;
    }

    public static function incrByTwo(): void
    {
        parent::incrByTwo();
    }
}

<?php

namespace Acme;

class StaticZero
{
    public static int $counter = 0;

    public static function incrByTwo(): void
    {
        self::$counter = self::$counter + 2;
    }
}

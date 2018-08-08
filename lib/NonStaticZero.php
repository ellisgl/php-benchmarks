<?php

namespace Acme;

class NonStaticZero
{
    public $counter = 0;

    public function incrByTwo()
    {
        $this->counter = $this->counter + 2;
    }
}
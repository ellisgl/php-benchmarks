<?php

namespace Acme;

class NonStaticOne extends NonStaticZero
{
    public function incrByOne()
    {
        $this->counter = $this->counter + 1;
    }

    public function incrByTwo()
    {
        parent::incrByTwo();
    }
}
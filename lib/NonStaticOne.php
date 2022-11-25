<?php

namespace Acme;

class NonStaticOne extends NonStaticZero
{
    public function incrByOne(): void
    {
        $this->counter = $this->counter + 1;
    }
}

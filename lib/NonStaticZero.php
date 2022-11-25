<?php

namespace Acme;

class NonStaticZero
{
    public int $counter = 0;

    public function incrByTwo(): void
    {
        $this->counter = $this->counter + 2;
    }
}

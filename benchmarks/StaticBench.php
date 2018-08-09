<?php
// vendor\bin\phpbench run benchmarks\StaticBench.php --report=aggregate

/**
 * @Revs(100)
 * @Iterations(100)
 */
class StaticBench
{
    public function benchStatic()
    {
        Acme\StaticOne::incrByOne();
        Acme\StaticOne::incrByTwo();
    }

    public function benchNonStatic()
    {
        $obj = new Acme\NonStaticOne();

        $obj->incrByOne();
        $obj->incrByTwo();
    }
}
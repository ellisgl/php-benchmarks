<?php
// vendor\bin\phpbench run benchmarks\StaticBench.php --report=aggregate
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Revs(100)
 * @Iterations(100)
 */
class StaticBench
{
    public function benchStatic(): void
    {
        Acme\StaticOne::incrByOne();
        Acme\StaticOne::incrByTwo();
    }

    public function benchNonStatic(): void
    {
        $obj = new Acme\NonStaticOne();

        $obj->incrByOne();
        $obj->incrByTwo();
    }
}

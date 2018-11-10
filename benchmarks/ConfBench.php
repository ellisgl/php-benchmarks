<?php
// vendor\bin\phpbench run benchmarks\ConfBench.php --report=aggregate

/**
 * @Revs(100)
 * @Iterations(100)
 */
class ConfBench
{
    public function benchArrayConf()
    {
        $confDir = __DIR__ . DIRECTORY_SEPARATOR . 'confs' . DIRECTORY_SEPARATOR . 'php' .DIRECTORY_SEPARATOR;
        $conf = new \Acme\ArrayConf($confDir . 'system.php', $confDir);
        $conf->load();
    }

    public function benchINIConf()
    {
        $confDir = __DIR__ . DIRECTORY_SEPARATOR . 'confs' . DIRECTORY_SEPARATOR . 'ini' .DIRECTORY_SEPARATOR;
        $conf = new \GeekLab\INIConf($confDir . 'system.ini', $confDir);
        $conf->load();
    }

}
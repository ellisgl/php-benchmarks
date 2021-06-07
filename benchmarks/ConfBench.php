<?php
// vendor\bin\phpbench run benchmarks\ConfBench.php --report=aggregate

/**
 * @Revs(100)
 * @Iterations(100)
 */
class ConfBench
{
    public function benchGeekLabConfJSON(): void
    {
        $confDir = __DIR__ . DIRECTORY_SEPARATOR . 'confs' . DIRECTORY_SEPARATOR .'geeklab-conf' . DIRECTORY_SEPARATOR . 'json' . DIRECTORY_SEPARATOR;
        //$conf = new GeekLab\Conf\JSON($confDir . 'system.json', $confDir);
        $conf = new GeekLab\Conf\GLConf(new GeekLab\Conf\Driver\JSONConfDriver($confDir . 'system.json', $confDir));
        $conf->init();
    }

    public function benchGeekLabConfYAML(): void
    {
        $confDir = __DIR__ . DIRECTORY_SEPARATOR . 'confs' . DIRECTORY_SEPARATOR .'geeklab-conf' . DIRECTORY_SEPARATOR . 'yaml' . DIRECTORY_SEPARATOR;
        $conf = new GeekLab\Conf\GLConf(new GeekLab\Conf\Driver\YAMLConfDriver($confDir . 'system.yaml', $confDir));
        $conf->init();
    }

    public function benchGeekLabConfINI(): void
    {
        $confDir = __DIR__ . DIRECTORY_SEPARATOR . 'confs' . DIRECTORY_SEPARATOR .'geeklab-conf' . DIRECTORY_SEPARATOR . 'ini' . DIRECTORY_SEPARATOR;
        $conf = new GeekLab\Conf\GLConf(new GeekLab\Conf\Driver\INIConfDriver($confDir . 'system.ini', $confDir));
        $conf->init();
    }

    public function benchGeekLabConfArr(): void
    {
        $confDir = __DIR__ . DIRECTORY_SEPARATOR . 'confs' . DIRECTORY_SEPARATOR .'geeklab-conf' . DIRECTORY_SEPARATOR . 'array' . DIRECTORY_SEPARATOR;
        $conf = new GeekLab\Conf\GLConf(new GeekLab\Conf\Driver\ArrayConfDriver($confDir . 'system.php', $confDir));
        $conf->init();
    }


}

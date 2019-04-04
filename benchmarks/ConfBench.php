<?php
// vendor\bin\phpbench run benchmarks\ConfBench.php --report=aggregate

/**
 * @Revs(100)
 * @Iterations(100)
 */
class ConfBench
{
    public function benchGeekLabConfJSON()
    {
        $confDir = __DIR__ . DIRECTORY_SEPARATOR . 'confs' . DIRECTORY_SEPARATOR .'geeklab-conf' . DIRECTORY_SEPARATOR . 'json' . DIRECTORY_SEPARATOR;
        $conf = new GeekLab\Conf\JSON($confDir . 'system.json', $confDir);
        $conf->init();
    }

    public function benchGeekLabConfYAML()
    {
        $confDir = __DIR__ . DIRECTORY_SEPARATOR . 'confs' . DIRECTORY_SEPARATOR .'geeklab-conf' . DIRECTORY_SEPARATOR . 'yaml' . DIRECTORY_SEPARATOR;
        $conf = new GeekLab\Conf\YAML($confDir . 'system.yaml', $confDir);
        $conf->init();
    }

    public function benchGeekLabConfINI()
    {
        $confDir = __DIR__ . DIRECTORY_SEPARATOR . 'confs' . DIRECTORY_SEPARATOR .'geeklab-conf' . DIRECTORY_SEPARATOR . 'ini' . DIRECTORY_SEPARATOR;
        $conf = new GeekLab\Conf\INI($confDir . 'system.ini', $confDir);
        $conf->init();
    }

    public function benchGeekLabConfArr()
    {
        $confDir = __DIR__ . DIRECTORY_SEPARATOR . 'confs' . DIRECTORY_SEPARATOR .'geeklab-conf' . DIRECTORY_SEPARATOR . 'array' . DIRECTORY_SEPARATOR;
        $conf = new GeekLab\Conf\Arr($confDir . 'system.php', $confDir);
        $conf->init();
    }


}

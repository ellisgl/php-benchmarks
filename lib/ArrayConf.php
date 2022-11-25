<?php

namespace Acme;

class ArrayConf
{
    private string $mainFile; // Main configuration file name.
    private string $confLocation; // Location of extra configuration files.
    private array $config = array(); // The generated configuration.

    /**
     * INIConf constructor.
     *
     * @param string $mainFile
     * @param string $confLocation
     */
    public function __construct(string $mainFile, string $confLocation = 'conf')
    {
        // Load in main INI file.
        $this->mainFile = $mainFile;
        $this->confLocation = $confLocation;
    }

    /**
     * Get data with dot notation.
     * Stolen from: https://stackoverflow.com/a/14706302/344028
     *
     * @param string $key Key
     *
     * @return array | bool | string
     */
    public function get(string $key): bool | array | string
    {
        $key = strtoupper($key);
        $conf = $this->config;
        $pos = strtok($key, '.');

        while ($pos !== false) {
            if (!isset($conf[$pos])) {
                return false;
            }

            $conf = $conf[$pos];
            $pos = strtok('.');
        }

        return $conf;
    }

    /**
     * Return the complete config as an array.
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->config;
    }

    /**
     * Import an INI file and work some magic
     *
     * @param string $confFile
     */
    private function import(string $confFile): void
    {
        // Load and parse the Config
        //$config = parse_ini_file($confFile, true);
        $config = include($confFile);

        // Uppercase and change spaces and periods to underscores in key names.
        $config = $this->conformArray($config);

        // Strip out anything that wasn't in a section
        // We don't want the ability to overwrite stuff from main INI file.
        foreach ($config as $k => $v) {
            if (!is_array($v)) {
                unset($config[$k]);
            }
        }

        // Combine/Merge/Overwrite new config with current.
        $this->config = array_replace_recursive($this->config, $config);
    }

    public function load(): void
    {
        // Load in main INI file.
        //$this->config = parse_ini_file($this->mainFile);
        $this->config = include($this->mainFile);

        // Uppercase and change spaces to underscores in key names.
        $this->config = $this->conformArray($this->config);

        // Load in the extra configs via the CONF[] property, and some magic!
        if (isset($this->config['CONF']) && is_array($this->config['CONF'])) {
            foreach ($this->config['CONF'] as $file) {
                $this->import($this->confLocation . $file . '.php');
            }
        }

        // Now replace any macros.
        $this->config = $this->macroReplace($this->config);
    }

    /**
     * Replace macros.
     *
     * @param array | string $data
     *
     * @return array | string
     */
    private function macroReplace(array | string $data): array | string
    {
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                // Can't do string operations on an array.
                if (!is_array($v)) {
                    // Find the macro placeholders, replace them with what's in the config.
                    $newValue = preg_replace_callback('/{%([a-zA-Z0-9_.-]*?)%}/', function ($matches) {
                        return ($this->get($matches[1])) ? $this->get($matches[1]) : $matches[0];
                    },                                $v);

                    // Looks like we have a macro'd macro.
                    if ($newValue !== $v && preg_match('/{%([a-zA-Z0-9_.-]*?)%}/', $newValue)) {
                        $newValue = $this->macroReplace($newValue);
                    }

                    $data[$k] = $newValue;
                } else {
                    // Go into the array.
                    $data[$k] = $this->macroReplace($v);
                }
            }
        } else {
            // Deal with a string input, instead of an array.
            return preg_replace_callback(
                '/{%([a-zA-Z0-9_.-]*?)%}/',
                function ($matches) {
                    $nv = ($this->get($matches[1])) ? $this->get($matches[1]) : $matches[0];
                    // Do we have a macro'd macro? Let's fill that in.
                    if ($nv !== $matches[0] && preg_match('/{%(.*?)%}/', $nv)) {
                        $nv = $this->macroReplace($nv);
                    }

                    return $nv;
                },
                $data
            );
        }

        return ($data);
    }

    /**
     * Make the array conform to some standards.
     * Convert key names to uppercase.
     * Convert spaces and periods to underscores.
     *
     * @param array $arr
     *
     * @return array
     */
    private function conformArray(array $arr): array
    {
        // Convert keys to uppercase
        $arr = array_change_key_case($arr, CASE_UPPER);
        $fixed = array();

        foreach ($arr as $k => $v) {
            if (is_array($v)) {
                $v = $this->conformArray($v);
            }

            // Replace spaces and periods with underscores.
            $fixed[preg_replace('/\s+|\.+/', '_', $k)] = $v;
        }

        return $fixed;
    }
}

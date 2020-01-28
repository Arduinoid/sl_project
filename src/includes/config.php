<?php

class Config
{
    private static $instance;
    private function __construct($configPath)
    {
        $config = json_decode(file_get_contents($configPath));
        if (!is_null($config))
        { $this->configData = $config; }
        else
        { throw new Exception('Unable to pull config'); }
    }

    public static function load($configPath)
    {
        if (!isset(static::$instance)) {
            static::$instance = new Config($configPath);
        }

        return static::$instance;
    }
}
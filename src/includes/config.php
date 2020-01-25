<?php

class Config
{
    private static $instance;
    private function __construct($configPath)
    {
        $this->configData = json_decode(file_get_contents($configPath));
    }

    public static function load($configPath)
    {
        if (!isset(static::$instance)) {
            static::$instance = new Config($configPath);
        }

        return static::$instance;
    }
}
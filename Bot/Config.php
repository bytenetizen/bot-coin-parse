<?php

namespace Bot;

use Exception;

class Config
{

    /**
     * @return array|false
     * @throws Exception
     */
    public static function getConfigFile()
    {
        $patch = dirname(__DIR__).'/config.ini';
        if(!file_exists($patch)){
            throw new Exception('Non config file');
        }
        return parse_ini_file($patch);
    }

    /**
     * @param string $configName
     * @return mixed
     * @throws Exception
     */
    public static function getSomeConfigName(string $configName)
    {
        $iniArray = [];
        try {
            $iniArray = self::getConfigFile();
        } catch (Exception $e) {
        }

        if(isset($iniArray[$configName])){
            return $iniArray[$configName];
        }

        throw new Exception('Non config key');

    }

}

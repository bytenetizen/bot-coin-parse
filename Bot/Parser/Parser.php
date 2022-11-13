<?php

namespace Bot\Parser;

class Parser
{

    public function do()
    {

        $dir = dirname(__DIR__).'/Parser';
        $dh  = opendir($dir);
        while (false !== ($filename = readdir($dh))){
            $class = 'Bot\Parser\\'.ucfirst($filename).'\\'.ucfirst($filename);
            if (class_exists($class)){
                $readyClass = new $class();
                $readyClass->getData();
            }
        }
    }

}

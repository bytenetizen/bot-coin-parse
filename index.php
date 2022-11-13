<?php

use Bot\Config;
use Bot\DB\Connect;
use Bot\Parser\Parser;

require __DIR__ . '/vendor/autoload.php';

Config::getConfigFile();

Connect::isConn();

$parser = new Parser();
$parser->do();

echo 'ok';

<?php

namespace Bot\DB;

use Bot\Config;
use Exception;

class Connect
{

    protected string $host,$port,$dbname,$user,$password,$connStr;

    /**
     * Connect constructor.
     * @throws Exception
     */
    function __construct()
    {
        $this->host = Config::getSomeConfigName('db_host');
        $this->port = Config::getSomeConfigName('db_port');
        $this->dbname = Config::getSomeConfigName('db_database');
        $this->user = Config::getSomeConfigName('db_username');
        $this->password = Config::getSomeConfigName('db_password');
        $this->connStr = "host={$this->host} port={$this->port} 
                dbname={$this->dbname} user={$this->user} password={$this->password}";

    }

    public static function isConn()
    {
        $self = new self();

        $dbConn = pg_connect($self->connStr) or die('Not connect db');

        pg_close($dbConn);
    }

    /**
     * @return false|resource
     * @throws Exception
     */
    public function conn()
    {
        $connStr = "host={$this->host} port={$this->port} dbname={$this->dbname} user={$this->user} password={$this->password}";
        $conn = pg_connect($connStr);
        if (!$conn){
            throw new Exception('Not connect db');
        }

        return $conn;
    }
}

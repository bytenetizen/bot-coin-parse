<?php

namespace Bot\Models;

use Bot\DB\Connect;

class Model
{
    protected object $conn;

    /**
     * @return false|object|resource
     * @throws \Exception
     */
    public function getConnection()
    {
        $this->conn = (new Connect())->conn();

        return $this->conn;
    }

}

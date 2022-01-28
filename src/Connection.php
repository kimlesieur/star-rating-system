<?php
namespace App;

use \PDO;

class Connection {
    public static function getPDO(): PDO
    {
        return new PDO ('mysql:dbname=star-rating-system;host=localhost:3307', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    }



}

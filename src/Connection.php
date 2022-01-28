<?php
namespace App;

use \PDO;

class Connection {
    public static function getPDO(): PDO
    {
        return new PDO ("mysql:dbname={$_ENV["DB_NAME"]};host={$_ENV["HOST"]}", "{$_ENV["USERNAME"]}", "{$_ENV["PASSWORD"]}", 
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        
    }



}

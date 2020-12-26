<?php

namespace src\Core;

use \src\Config;

class Database {

  private static $pdo;

  public function connect(){

    try{

      self::$pdo = new \PDO("mysql:dbname=".Config::DB_NAME.";host=".Config::DB_HOST.";", Config::DB_USER, Config::DB_PASS);

    } catch(\PDOException $e) {
      echo "Error: ".$e->getMessage();
    }    

    return self::$pdo;
  }
  
}
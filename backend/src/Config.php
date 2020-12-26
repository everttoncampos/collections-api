<?php
namespace src;

class Config {

  const DB_HOST = 'localhost';
  const DB_NAME = 'collections2';
  const DB_USER = 'root';
  const DB_PASS = '';

  const BASE_URL = 'http://localhost/collections/backend/';

  // public function connect(){

  //   try{

  //     $pdo = new \PDO("mysql:dbname=".Config::DB_NAME.";host=".Config::DB_HOST.";", Config::DB_USER, Config::DB_PASS);

  //   } catch(\PDOException $e) {
  //     echo "Error: ".$e->getMessage();
  //   }    

  //   return $pdo;
  // }

  // const = $pdo = new PDO("mysql:dbname=$db_name;host=$db_host", $db_user, $db_pass);
}

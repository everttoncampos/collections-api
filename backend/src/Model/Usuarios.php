<?php

namespace src\Model;

use src\Core\Database;

class Usuarios {

  private static $array = [];

  // public function __construct($email, $senha){
  //   $data = $this->verificaUsuario($email, $senha);
  //   // print_r($data);
  //   return $data;
  // }

  public function verificaUsuario($email, $senha, $array) {
    $con = new Database();
    $db = $con->connect();

    $sql = $db->prepare("SELECT email FROM usuarios WHERE email = :email");
    $sql->bindValue(":email", $email);
    $sql->execute();



    if ($sql->rowCount() > 0){

      $sql = $db->prepare("SELECT id, email, admin FROM usuarios WHERE email = :email AND senha = :senha");
      $sql->bindValue(":email", $email);
      $sql->bindValue(":senha", $senha);
      $sql->execute();

      if ($sql->rowCount() > 0) {

        $data = $sql->fetch(\PDO::FETCH_ASSOC);
        return json_encode($data);

      } else {
        self::$array['success'] = false;
        self::$array['error'] = "Senha inválida!";
        return self::$array;

      }
      
    } else {
      self::$array['success'] = false;
      self::$array['error'] = 'Email inválido!';
      return self::$array;

    }

    
  }
  
}
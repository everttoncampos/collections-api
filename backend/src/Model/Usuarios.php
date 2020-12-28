<?php

namespace src\Model;

use src\Core\Database;

class Usuarios {

  private static $array = [];
  private static $con;
  private static $db;
  
  public function __construct() {
    self::$con = new Database();
    self::$db = self::$con->connect();
  }

  public function verificaUsuario($email, $senha) {

    $sql = self::$db->prepare("SELECT email FROM usuarios WHERE email = :email");
    $sql->bindValue(":email", $email);
    $sql->execute();

    if ($sql->rowCount() > 0){

      $sql = self::$db->prepare("SELECT id, email, admin, datahora FROM usuarios WHERE email = :email AND senha = :senha");
      $sql->bindValue(":email", $email);
      $sql->bindValue(":senha", $senha);
      $sql->execute();

      if ($sql->rowCount() > 0) {

        date_default_timezone_set('America/Campo_Grande');

        $date = date('Y/m/d H:i:s');
        

        $data = $sql->fetch(\PDO::FETCH_ASSOC);

        $this->updateDate($data['id'], $date);

        // return json_encode($data);
        return $data;

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

  public function updateDate($id, $date) {
    $sql = self::$db->prepare('UPDATE usuarios SET datahora = :date WHERE id = :id');
    $sql->bindValue(':date', $date);
    $sql->bindValue(':id', $id);
    $sql->execute();
  }
  
}
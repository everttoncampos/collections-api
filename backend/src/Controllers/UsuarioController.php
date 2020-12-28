<?php

namespace src\Controllers;

use src\Model\Usuarios;

class UsuarioController {

  private static $array = [];

  public function verificaUsuario($email, $senha){

    $user = new Usuarios();

    $data = $user->verificaUsuario($email, $senha);

    if (isset($data)) {      

      if (isset($data['success']) && $data['success'] = 'false') {
        
        self::$array['success'] = false;
        self::$array['error'] = $data['error'];
        
        return self::$array;

      } else {
        // echo $data;
        // $data = json_decode($data);
        self::$array['success'] = true;
        self::$array['result']['User'] = $data;      
        return self::$array;

      }

    }
  }

}
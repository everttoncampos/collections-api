<?php

namespace src\Controllers;

use src\Model\Usuarios;

class UsuarioController {

  private static $array = [];

  public function verificaUsuario($email, $senha){

    $user = new Usuarios();

    $data = $user->verificaUsuario($email, $senha, self::$array);

    // print_r(isset($data['error']));

    if (isset($data)) {      

      if (isset($data['success']) && $data['success'] = 'false') {
        
        self::$array['success'] = false;
        self::$array['error'] = $data['error'];
        
        return self::$array;

      } else {
        // echo $data;
        $data = json_decode($data);
        self::$array['success'] = true;
        self::$array['result']['User'] = $data;      
        return self::$array;

      }

      
     

      // self::$array['result']['User'] = $data;
      
      // return self::$array;

    }
    //  else {  

    //   return json_encode($array['error'] = "Usuário/senha inválidos!");

    // }
    

    // echo "deu certo";
  }
}
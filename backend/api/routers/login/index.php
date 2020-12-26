<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Text: application/json");

require '../../../vendor/autoload.php';

use src\Controllers\UsuarioController;


$method = strtoupper($_SERVER['REQUEST_METHOD']);

if($method === 'POST') {

  if (!empty($_POST['email']) && !empty($_POST['senha'])) {

    $email = filter_input(INPUT_POST, 'email');
    $senha = filter_input(INPUT_POST, 'password');

  } else {

    $dados = file_get_contents("php://input");
    $dados = json_decode($dados, true);

    $email = $dados['email'];
    $senha = $dados['senha'];
    
  }

  if(!empty($email) && !empty($senha)) {

    $u = new UsuarioController();
    $dadosUsuario = $u->verificaUsuario($email, $senha);

    if ($dadosUsuario) {
      echo json_encode($dadosUsuario);    
    }
  }

} else {
  echo $array['error'] = 'Método inválido, permitido somente POST';
}


// require('../return.php');


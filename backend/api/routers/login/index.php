<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Text: application/json");

require '../../../vendor/autoload.php';

use src\Controllers\UsuarioController;
use src\Controllers\ProfessorController;


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

    $user = new UsuarioController();
    $array = $user->verificaUsuario($email, $senha);

    if ($array['success'] == '1' && $array['result']['User']['admin'] === '0') {

      echo json_encode($array); 

    } elseif ($array['success'] == '1' && $array['result']['User']['admin'] === '1') {
      $prof = new ProfessorController();
      $professores = $prof->getProfessores();

      $array['result']['professores'] = $professores;

      echo json_encode($array);
      
      // echo "Deu algum erro!";
    }
  }

} else {
  $array['success'] = false;
  $array['error'] = 'Método inválido, permitido somente POST';
  echo json_encode($array);
}


// require('../return.php');


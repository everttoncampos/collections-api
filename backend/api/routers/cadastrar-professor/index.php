<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Text: application/json");

require '../../../vendor/autoload.php';

use src\Controllers\ProfessorController;

$method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($method === 'POST') {

  if (!empty($_POST['nome']) && !empty($_POST['sobrenome']) && !empty($_POST['telefone'])) {

    $nome = filter_input(INPUT_POST, 'nome');
    $sobrenome = filter_input(INPUT_POST, 'sobrenome');
    $telefone = filter_input(INPUT_POST, 'telefone');

    if (!empty($_POST['email']) && !empty($_POST['senha'])) {

      $email = filter_input(INPUT_POST, 'email');
      $senha = filter_input(INPUT_POST, 'senha');

    }

  } else {

    $dados = file_get_contents('php://input');
    $dados = json_decode($dados, true);

    $nome = $dados['nome'];
    $sobrenome = $dados['sobrenome'];
    $telefone = $dados['telefone'];
    $email = $dados['email'];
    $senha = $dados['senha'];
    
  }

  if ($nome && $sobrenome && $telefone) {
    
    if ($email && $senha) {

      $controllerProfessor = new ProfessorController();

      $idProfessor = $controllerProfessor->cadastroUsuarioProfessor($nome, $sobrenome, $telefone, $email, $senha);

      if ($idProfessor) {
        $dados = $controllerProfessor->getProfessor($idProfessor);
        echo json_encode($dados);
      }

    } else {
      $array['success'] = false;
      $array['error'] = "Email/Senha precisão ser preenchidos!";
      echo json_encode($array);
    }
    
  } else {

    $array['success'] = false;
    $array['error'] = "Nome/Sobrenome/Telefone precisão ser preenchidos!";
    echo json_encode($array);

  }

} else {
  $array['success'] = false;
  $array['error'] = 'Método inválido, permitido somente POST';

  echo json_encode($array);
}





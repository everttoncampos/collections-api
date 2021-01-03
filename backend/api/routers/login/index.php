<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Text: application/json");

require '../../../vendor/autoload.php';

use src\Controllers\UsuarioController;
use src\Controllers\ProfessorController;
use src\Controllers\AlunoController;
use src\Controllers\QuestionarioController;


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

    if ($array['success'] == '1' && $array['result']['User']['admin'] === 'N') {

      $idProfessor = $array['result']['User']['id'];

      $questionario = new QuestionarioController();
      $questionarios = $questionario->getQuestionariosProfessor($idProfessor);
      
      $aluno = new AlunoController();
      $alunos = $aluno->getAlunosProfessor($idProfessor);

      $array['result']['questionarios'] = $questionarios;
      $array['result']['alunos'] = $alunos;

      echo json_encode($array); 

    } elseif ($array['success'] == '1' && $array['result']['User']['admin'] === 'S') {

      $prof = new ProfessorController();
      $professores = $prof->getProfessores();
      $aluno = new AlunoController();
      $alunos = $aluno->getAlunos();
      $questionario = new QuestionarioController();
      $questionarios = $questionario->getQuestionarios();

      $array['result']['professores'] = $professores;
      $array['result']['questionarios'] = $questionarios;
      $array['result']['alunos'] = $alunos;
      echo json_encode($array);

    } 
  }

} else {
  $array['success'] = false;
  $array['error'] = 'Método inválido, permitido somente POST';
  echo json_encode($array);
}


// require('../return.php');


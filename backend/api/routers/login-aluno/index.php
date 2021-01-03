<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: POST');
header('Content-type: application/json');

require '../../../vendor/autoload.php';

use src\Controllers\AlunoController;
use src\Controllers\QuestionarioController;

$method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($method === 'POST') {

  if (!empty($_POST['cpf'])) {

    $cpf = filter_input(INPUT_POST, 'cpf');

  } else {
    $dados = file_get_contents('php://input');
    $dados = json_decode($dados, true);

    $cpf = $dados['cpf'];
  }

  if (isset($cpf)) {

    $aluno = new AlunoController();
    $array = $aluno->verificaAluno($cpf);

    if ($array) {

      $idTurma = $array['result']['User']['turma_id'];

      $questionario = new QuestionarioController();
      $questionarios = $questionario->getQuestionariosTurmaId($idTurma);

      $array['questionarios'] = $questionarios;
      $array['relatorios'] = [];

      echo json_encode($array);
    } else {
      $array['success'] = false;
      $array['error'] = "CPF informado inválido.";
      echo json_encode($array);
    }

  } else {
    $array['success'] = false;
    $array['error'] = 'CPF não informado.';
    echo json_encode($array);
  }


} else {
  $array['success'] = false;
  $array['error'] = 'Método inválido. Permitido somente POST';
  echo json_encode($array);
}
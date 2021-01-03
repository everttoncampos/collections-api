<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: *');
header('Content-Type: appplication/json');

require '../../../vendor/autoload.php';

use src\Controllers\QuestionarioController;

$method = strtoupper($_SERVER['REQUEST_METHOD']);


if ($method === 'POST') {

  if (!empty($_POST['questoes'])) {

    $titulo = filter_input(INPUT_POST, 'titulo');
    $turma = filter_input(INPUT_POST, 'turma');
    $descricao = filter_input(INPUT_POST, 'descricao');
    $questoes = filter_input(INPUT_POST, 'questoes');

    $questionario = new QuestionarioController();
    $idQuestionario = $questionario->cadastrarQuestionario($turma, $titulo, $descricao);
    $questionario->cadastrarRespostas($idQuestionario, $questoes);

  } else {
    
    $dados = file_get_contents('php://input');
    $dados = json_decode($dados, true);
    
    $titulo = $dados['titulo'];
    $turma = $dados['turma'];
    $descricao = $dados['descricao'];
    $questoes = $dados['questoes'];

    $questionario = new QuestionarioController();
    $idQuestionario = $questionario->cadastrarQuestionario($turma, $titulo, $descricao);
    $questionario->cadastrarRespostas($idQuestionario, $questoes);
    
  }


} else {
  $array['success'] = false;
  $array['error'] = 'Método inválido. Permitido somente POST';
  echo json_encode($array);
}

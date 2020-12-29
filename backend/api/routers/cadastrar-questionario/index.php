<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: *');
header('Content-Type: appplication/json');

require '../../../vendor/autoload.php';

$method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($method === 'POST') {

  if (!empty($_POST['questoes'])) {

    

  } else {
    
    $dados = file_get_contents('php://input');
    $dados = json_decode($dados, true);
    
    $titulo = $dados['titulo'];
    $turma = $dados['turma'];
    $descricao = $dados['descricao'];

    $countQuestoes = count($dados['questoes']);

    if (!empty($countQuestoes) && $countQuestoes > 0) {
      for($i = 0; $i < $countQuestoes; $i++) {
        $questoes['pergunta'.$i] = $dados['questoes'][$i];
      }
    }

    $array['titulo'] = $titulo;
    $array['turma'] = $turma;
    $array['descricao'] = $descricao;
    $array['questoes'] = $questoes;

    echo json_encode($array);



  }

  // if (!empty($_POST['titulo']) && !empty($_POST['turma']) && !empty($_POST['descricao'])) {

  //   if 

  // }


} else {
  $array['success'] = false;
  $array['error'] = 'Método inválido. Permitido somente POST';
  echo json_encode($array);
}

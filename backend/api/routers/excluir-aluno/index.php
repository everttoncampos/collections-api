<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: GET");
header("Content-Type: application/json");

require "../../../vendor/autoload.php";

use src\Controllers\AlunoController;

$method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($method === 'GET') {

  if (!empty($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id');
  }

  if ($id) {
    $aluno = new AlunoController();
    $aluno->excluirAluno($id);

  } else {
    $array['success'] = false;
    $array['error'] = "ID não enviado.";
    echo json_encode($array);
  }

} else {
  $array['success'] = false;
  $array['error'] = "Método inválido. Permitido somente GET.";
  echo json_encode($array);
}
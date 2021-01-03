<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: GET");
header("Content-Type: application/json");

require "../../../vendor/autoload.php";

use src\Controllers\ProfessorController;

$method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($method === 'GET') {

  if (!empty($_GET['id'])) {

    $id = (int) filter_input(INPUT_GET, 'id');

  } else {
    $array['success'] = false;
    $array['error'] = "ID não enviado!";
    echo json_encode($array);
  }

  $prof = new ProfessorController();

  $dados = $prof->excluirProfessor($id);

  echo json_encode($dados);


  // echo json_encode($_GET['id']);


} else {

  $array['success'] = false;
  $array['error'] = "Método inválido. Permitido somente GET.";
  echo json_encode($array);
}
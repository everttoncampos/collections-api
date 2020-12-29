<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: *');
header('Context-Type: application/json');

require '../../../vendor/autoload.php';

use src\Controllers\AlunoController;

$method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($method === 'POST') {

    if (!empty($_POST['nome']) && !empty($_POST['sobrenome']) && !empty($_POST['telefone']) && !empty($_POST['CPF'])) {

      $nome = filter_input(INPUT_POST, 'nome');
      $sobrenome = filter_input(INPUT_POST, 'sobrenome');
      $cpf = filter_input(INPUT_POST, 'cpf');
      $turma = filter_input(INPUT_POST, 'turma');

    } else {
      $dados = file_get_contents('php://input');
      $dados = json_decode($dados, true);

      $nome = $dados['nome'];
      $sobrenome = $dados['sobrenome'];
      $cpf = $dados['cpf'];
      $turma = (int)$dados['turma'];
    }

    if ($nome && $sobrenome && $cpf && $turma ) {
      $aluno = new AlunoController();
      $dadosAluno = $aluno->cadastrarAluno($nome, $sobrenome, $cpf, $turma);

      echo json_encode($dadosAluno);

    } else {
      $array['success'] = false;
      $array['error'] = 'Todos os campos precisam ser preenchidos corretamente!';
      echo json_encode($array);
    }


} else {

  $array['success'] = false;
  $array['error'] = 'Método inválido. Permitido apenas POST';
  echo json_encode($array);

}
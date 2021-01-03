<?php

namespace src\Controllers;

use src\Model\Aluno;

class AlunoController {

  private static $aluno;

  public function __construct(){
    self::$aluno = new Aluno();
  }

  public function verificaAluno($cpf){
    $aluno = self::$aluno->verificaAluno($cpf);

    $array['success'] = true;
    $array['result']['User'] = $aluno;
    return $array;
  }

  public function cadastrarAluno ($nome, $sobrenome, $cpf, $turma) {
    $val = self::$aluno->cadastrarAluno($nome, $sobrenome, $cpf, $turma);

    if ($val) {
      $dados = self::$aluno->getAlunosProfessor($turma);
      return $dados;
    }

  }

  public function getAlunos() {
    $alunos = self::$aluno->getAlunos();
    return $alunos;
  }

  public function getAlunosProfessor($id) {
    $alunos = self::$aluno->getAlunosProfessor($id);
    // echo json_encode($alunos);
    return $alunos;
  }

  public function excluirAluno($id) {
    try {
      self::$aluno->excluirAluno($id);

    } catch (PDOException $e) {
      echo "Error: ".$e->getMessage();
      
    }
  }


}
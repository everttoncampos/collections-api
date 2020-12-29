<?php

namespace src\Controllers;

use src\Model\Aluno;

class AlunoController {

  private static $aluno;

  public function __construct(){
    self::$aluno = new Aluno();
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


}
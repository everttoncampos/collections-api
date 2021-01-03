<?php

namespace src\Controllers;

use src\Model\Questionario;

class QuestionarioController {

  private static $questionario;

  public function __construct() {
    self::$questionario = new Questionario();
  }

  public function cadastrarQuestionario($turma, $titulo, $descricao) {
    $idQuestionario = self::$questionario->cadastrarQuestionario($turma, $titulo, $descricao);

    return $idQuestionario;

  }

  public function cadastrarRespostas($idQuestionario, $respostas) {
    self::$questionario->cadastrarRespostas($idQuestionario, $respostas);
  }

  public function getQuestionarios() {
    return self::$questionario->getQuestionarios();
  }

  public function getQuestionariosTurmaId($id) {
    return self::$questionario->getQuestionariosTurmaId($id);
  }

  public function getQuestionariosProfessor($id) {
    $questionarios = self::$questionario->getQuestionariosProfessor($id);
    return $questionarios;
  }

}
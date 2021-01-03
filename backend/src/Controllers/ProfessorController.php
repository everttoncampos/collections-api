<?php

namespace src\Controllers;

use src\Model\Professor;

class ProfessorController {

  private static $array = [];
  static $prof;

  public function __construct(){
    self::$prof = new Professor();
  }

  public function cadastroProfessor($nome, $sobrenome, $telefone, $idProfessor) {

    self::$prof->cadastroProfessor($nome, $sobrenome, $telefone, $idProfessor);

  }

  public function cadastroUsuarioProfessor ($nome, $sobrenome, $telefone, $email, $senha) {

    $idProfessor = self::$prof->cadastroUsuarioProfessor($email, $senha);

    if($idProfessor) {

      $this->cadastroProfessor($nome, $sobrenome, $telefone, $idProfessor);
      return $idProfessor;

    }    
  }

  public function getProfessor($id){

    return self::$prof->getProfessor($id);

  }

  public function getProfessores() {
    return self::$prof->getProfessores();
  }

  public function excluirProfessor($id) {
    return self::$prof->excluirProfessor($id);
  }

}
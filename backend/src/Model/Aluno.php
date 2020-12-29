<?php

namespace src\Model;

use src\Core\Database;

class Aluno {

  private static $array;
  private static $con;
  private static $db;

  public function __construct() {

    self::$con = new Database();
    self::$db = self::$con->connect();

  }

  public function cadastrarAluno($nome, $sobrenome, $cpf, $turma) {
    
    $sql = self::$db->prepare('INSERT INTO aluno (nome, sobrenome, cpf, turma_id) VALUES (:nome, :sobrenome, :cpf, :turma_id)');
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':sobrenome', $sobrenome);
    $sql->bindValue(':cpf', $cpf);
    $sql->bindValue(':turma_id', $turma);
    $sql->execute();

    if ($sql) {
      return true;
    }

  }

  public function getAlunosProfessor($idTurma) {

    $sql = self::$db->prepare('SELECT * FROM aluno WHERE turma_id = :id');
    $sql->bindValue(':id', $idTurma);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $dados = $sql->fetchAll(\PDO::FETCH_ASSOC);
      return $dados;
    }

  }

  public function getAlunos() {
    $sql = self::$db->prepare('SELECT * FROM aluno');
    $sql->execute();

    if ($sql->rowCount() > 0){
      $dados = $sql->fetchAll(\PDO::FETCH_ASSOC);
      return $dados;
    }
  }

}
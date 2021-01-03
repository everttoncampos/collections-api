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

  public function verificaAluno($cpf) {
    $sql = self::$db->prepare("SELECT * FROM aluno WHERE cpf = :cpf");
    $sql->bindValue(':cpf', $cpf);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $dados = $sql->fetch(\PDO::FETCH_ASSOC);
      return $dados;
    }
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

  // public function getAlunosProfessor($idTurma) {
  //   $sql = self::$db->prepare('SELECT * FROM aluno WHERE turma_id = :id');
  //   $sql->bindValue(':id', $idTurma);
  //   $sql->execute();

  //   if ($sql->rowCount() > 0) {
  //     $dados = $sql->fetchAll(\PDO::FETCH_ASSOC);
  //     return $dados;      
  //   }
  // }

  public function getAlunos() {
    $sql = self::$db->prepare('SELECT * FROM aluno');
    $sql->execute();

    if ($sql->rowCount() > 0){
      $dados = $sql->fetchAll(\PDO::FETCH_ASSOC);
      return $dados;
    }
  }

  public function getAlunosProfessor($id) {

      $sql = self::$db->prepare("SELECT CONCAT(a.nome, ' ', a.sobrenome) nome_completo, a.cpf, a.turma_id FROM aluno a INNER JOIN turma t ON t.professor_id = :id INNER JOIN turma ON a.turma_id = turma.id WHERE turma.professor_id = :id");
      $sql->bindValue(':id', $id);
      $sql->execute();

    if ($sql->rowCount() > 0) {
      $sql = $sql->fetchAll(\PDO::FETCH_ASSOC);
      return $sql;
    }
  }

  public function excluirAluno($id) {
    self::$db->query("DELETE FROM aluno WHERE id = ".$id);
  }

}
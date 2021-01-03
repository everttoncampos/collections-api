<?php

namespace src\Model;

use src\Core\Database;

class Questionario {

  private static $con;
  private static $db;

  public function __construct() {
    self::$con = new Database();
    self::$db = self::$con->connect();
  }

  public function cadastrarQuestionario($turma, $titulo, $descricao) {
    $sql = self::$db->prepare('INSERT INTO questionario (turma_id, titulo, descricao) VALUES (:turma_id, :titulo, :descricao)');
    $sql->bindValue(':turma_id', $turma);
    $sql->bindValue(':titulo', $titulo);
    $sql->bindValue(':descricao', $descricao);
    $sql->execute();

    $id = self::$db->lastInsertId();
    return $id;
  }

  public function cadastrarRespostas($idQuestionario, $respostas) {

    $countRespostas = count($respostas);

    for ($i = 0; $i < $countRespostas; $i++) {

      $sql = self::$db->prepare("INSERT INTO questionario_items (respostas, correta, questionario_id) VALUES (:respostas, :correta, :id)");
      $sql->bindValue(':respostas', $respostas[$i]['resposta']);
      $sql->bindValue(':correta', $respostas[$i]['correta']);
      $sql->bindValue(':id', $idQuestionario);
      $sql->execute();
    }

  }

  public function getQuestionarios() {
    $sql = self::$db->prepare("SELECT * FROM questionario");
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $questionarios = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
    return $questionarios;
  }

  public function getQuestionariosProfessor($id) {
    $sql = self::$db->prepare("SELECT turma_id, titulo, descricao FROM questionario INNER JOIN turma ON turma.professor_id = :id AND questionario.turma_id = turma.id WHERE turma.professor_id = :id");
   $sql->bindValue('id', $id);
   $sql->execute();

   if ($sql->rowCount() > 0) {
     $dados = $sql->fetchAll(\PDO::FETCH_ASSOC);
     return $dados;
   }

  }

  public function getQuestionariosTurmaId($id) {
    $sql = self::$db->prepare("SELECT * FROM questionario WHERE turma_id = :id");
    $sql->bindValue('id', $id);
    $sql-> execute();

    if ($sql->rowCount() > 0) {
      $dados = $sql->fetchAll(\PDO::FETCH_ASSOC);
      return $dados;
    }
  }
  
}
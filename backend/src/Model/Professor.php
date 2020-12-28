<?php

namespace src\Model;

use src\Core\Database;

class Professor {

  private static $array = [];
  private static $con;
  private static $db;

  public function __construct() {
    self::$con = new Database();
    self::$db = self::$con->connect();
  }

  public function cadastroProfessor($nome, $sobrenome, $telefone, $idProfessor) {

    $sql = self::$db->prepare('INSERT INTO professor (nome, sobrenome, telefone, usuario_id)
    VALUES (:nome, :sobrenome, :telefone, :usuario_id)');
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':sobrenome', $sobrenome);
    $sql->bindValue(':telefone', $telefone);
    $sql->bindValue(':usuario_id', $idProfessor);
    $sql->execute();

    return true;

  }

  public function cadastroUsuarioProfessor($email, $senha) {

    date_default_timezone_set('America/Campo_Grande');
    $date = date('Y/m/d H:i:s');

    $sql = self::$db->prepare('INSERT INTO usuarios (email, senha, datahora) VALUES (:email, :senha, :datahora)');
    $sql->bindValue(':email', $email);
    $sql->bindValue(':senha', $senha);
    $sql->bindValue(':datahora', $date);
    $sql->execute();

    return self::$db->lastInsertId();

  }

  public function getProfessor($id) {

    $sql = self::$db->prepare('SELECT * FROM professor WHERE usuario_id = :id');
    $sql->bindValue(':id', $id);
    $sql->execute();

    if ($sql->rowCount() > 0 ){
      $dadosProfessor = $sql->fetch(\PDO::FETCH_ASSOC);

      return $dadosProfessor;
    }

  }

  public function getProfessores() {

    $sql = self::$db->query('SELECT * FROM professor');

    if ($sql->rowCount() > 0){
      $sql = $sql->fetchAll(\PDO::FETCH_ASSOC);
      return $sql;
    }
  }
  
}
<?php

namespace App\Models;

use MF\Model\Model;

class Usuario extends Model
{
  private $ID_User;
  private $nome;
  private $sobrenome;
  private $CPF;
  private $sexo;
  private $dataNasc;
  private $email;
  private $senha;

  public function __get($atributo) {
    return $this->$atributo;
  }

  public function __set($atributo, $valor) {
    $this->$atributo = $valor;
  }

  //salvar
  public function salvar()
  {
    $query = "insert into usuario(nome, sobrenome, CPF, sexo, dataNasc, email, senha)values(:nome, :sobrenome, :CPF, :sexo, :dataNasc, :email, :senha)";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':nome', $this->__get('nome')); 
    $stmt->bindValue(':sobrenome', $this->__get('sobrenome')); 
    $stmt->bindValue(':CPF', $this->__get('CPF')); 
    $stmt->bindValue(':dataNasc', $this->__get('dataNasc')); 
    $stmt->bindValue(':sexo', $this->__get('sexo')); 
    $stmt->bindValue(':email', $this->__get('email')); 
    $stmt->bindValue(':senha', $this->__get('senha'));
    $stmt->execute();

    return $this;
  }

  public function validarCadastro()
  {
    $valido = true;

    if(strlen($this->__get('nome')) < 3 ) {
      $valido = false;
    }

    if(strlen($this->__get('sobrenome')) < 3 ) {
      $valido = false;
    }

    if(strlen($this->__get('senha')) < 6 ) {
      $valido = false;
    }
    
    return $valido;
  }

  public function getUsuarioPorCpf()
  {
    $query = "select CPF from usuario where CPF = :CPF";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':CPF', $this->__get('CPF'));
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function autenticar() {
    $query = "select ID_User, nome, sobrenome, email, senha from usuario where email = :email and senha = :senha";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':email', $this->__get('email'));
    $stmt->bindValue(':senha', $this->__get('senha'));
    $stmt->execute();
    
    $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

    if($usuario['ID_User'] != '' && $usuario['nome'] != '' 
        && $usuario['sobrenome'] != '') {
      $this->__set('ID_User', $usuario['ID_User']);
      $this->__set('nome', $usuario['nome']); 
      $this->__set('sobrenome', $usuario['sobrenome']);
    }

    return $this;
  }
}
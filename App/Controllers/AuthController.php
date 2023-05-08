<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {
  
  public function autenticar() {

    $usuario = Container::getModel('Usuario');

    $usuario->__set('email', $_POST['email']);
    $usuario->__set('senha', md5($_POST['senha']));

    $usuario->autenticar();

    if(!empty($usuario->__get('ID_User')) && !empty($usuario->__get('nome')) 
    && !empty($usuario->__get('sobrenome'))) {
      
      session_start();

      $_SESSION['ID_User'] = $usuario->__get('ID_User');
      $_SESSION['nome'] = $usuario->__get('nome');

      header('Location: /timeline');
    } else {
      header('Location: /entrar?login=erro');
    }
  } 

  public function sair() {
    session_start();
    session_destroy();

    header('Location: /'); 
  }
}

?>
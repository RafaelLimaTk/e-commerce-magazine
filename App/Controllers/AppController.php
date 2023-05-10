<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {
  
  public function timeline() {
    
    session_start();

    if($_SESSION['ID_User'] != '' && $_SESSION['nome'] !='') {  
      
      // //recupera produto
      // $produto = Container::getModel('Produto');
      // $produtos = $produto->getAll();

      // $this->view->produtos = $produtos;

      $this->render('timeline');
    } else {
      header('Location: /entrar?login=erro');
    }
  }
}

?>
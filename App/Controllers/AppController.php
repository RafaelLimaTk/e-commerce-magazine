<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {
  
  public function timeline() {
    
    session_start();

    if($_SESSION['ID_User'] != '' && $_SESSION['nome'] !='') {  
      
      $produto = Container::getModel('Produto');
      $produtos = $produto->getAll();
      $produtosThree = $produto->getThreeProducts();
  
      foreach ($produtos as &$p) {
        $valor_numerico = $p['valor_numerico'];
        $p['valor_parcelado'] = $this->parcelas($valor_numerico, 6);
        $imgData = $p['img_prod'];
        $p['imgConvertida'] = 'data:image/jpeg;base64,' . base64_encode($imgData);
      }

      foreach ($produtosThree as &$pt) {
        $imgData = $pt['img_prod'];
        $pt['imgConvertida'] = 'data:image/jpeg;base64,' . base64_encode($imgData);
      }

      $this->view->produtos = $produtos;
      $this->view->produtosThree = $produtosThree;
      $this->render('timeline');
    } else {
      header('Location: /entrar?login=erro');
    }
  }

  public function parcelas($valor, $num_parcelas) {
    $valor_parcela = $valor / $num_parcelas;
    $valor_parcela_formatado = number_format($valor_parcela, 2, ',', '.');
    return "$num_parcelas"."x"." R$ $valor_parcela_formatado";
	}

  public function produto() {

    session_start();

    if($_SESSION['ID_User'] != '' && $_SESSION['nome'] !='') {

		  $this->render('produto');
    } else {
      header('Location: /entrar?login=erroAutenticar');
    }
	}
}

?>
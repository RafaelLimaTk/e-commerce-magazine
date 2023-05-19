<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {
  
  public function timeline() {
    
    session_start();

    if($_SESSION['ID_User'] != '' && $_SESSION['nome'] !='') {  

      $usuario = Container::getModel('Usuario');
      $usuarioLogged = $usuario->logged($_SESSION['ID_User']);
      
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

      $this->view->usuario = $usuarioLogged;
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

      $usuario = Container::getModel('Usuario');
      $usuarioLogged = $usuario->logged($_SESSION['ID_User']);

      $produtoId = $_GET['id'];

      $produto = Container::getModel('Produto');
      $produtoId = $produto->getProductId($produtoId);

      foreach ($produtoId as &$p) {
        $valor_desc = $p['valor_desc'];
        $desconto = $this->desconto($valor_desc, 15);
        $p['desconto'] = $desconto;
        $p['valor_parcelado'] = $this->parcelaDesc($p['desconto']);
        $imgData = $p['img_prod'];
        $p['imgConvertida'] = 'data:image/jpeg;base64,' . base64_encode($imgData);
      }

      $this->view->usuario = $usuarioLogged;
      $this->view->produtoId = $produtoId;
		  $this->render('produto');
    } else {
      header('Location: /entrar?login=erroAutenticar');
    }
	}

  public function desconto($valor_desconto, $porcentagem) {
    $desconto = $valor_desconto - ($valor_desconto * ($porcentagem / 100));
    $valor_desconto_formatado = number_format($desconto, 2, ',', '.');
    return $valor_desconto_formatado;
}

  public function parcelaDesc($desconto) {
    $valor_parcela_desc = (int)$desconto / 6;
    $valor_parcela_formatado = number_format($valor_parcela_desc, 2, ',', '.');
    return "<strong>6x R$ $valor_parcela_formatado</strong>";
}

}

?>
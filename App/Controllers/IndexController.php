<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

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
		$this->render('index');
	}

	public function parcelas($valor, $num_parcelas) {
    $valor_parcela = $valor / $num_parcelas;
    $valor_parcela_formatado = number_format($valor_parcela, 2, ',', '.');
    return "$num_parcelas"."x"." R$ $valor_parcela_formatado";
	}

	public function entrar() {
		
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$this->render('entrar');
	}

	public function inscreverse() {

		isset($this->view->erroSenhas);
		isset($this->view->erroCadastro);

		$this->render('inscreverse');
	}

	public function registrar() {
	
	$usuario = Container::getModel('Usuario');

	$usuario->__set('nome', $_POST['nome']);
	$usuario->__set('sobrenome', $_POST['Sobrenome']);
	$usuario->__set('email', $_POST['email']);
	$usuario->__set('senha', md5($_POST['senha']));
	$usuario->__set('CPF', $_POST['cpf']);
	$usuario->__set('dataNasc', $_POST['data-nasc']);
	$sexo = isset($_POST['sexo']) ? $_POST['sexo'] : 'm';
	$usuario->__set('sexo', $sexo);
	
	$senha = $_POST['senha'];
	$senha2 = $_POST['senha-2'];

	if ($senha !== $senha2) {
		$this->view->erroSenhas = true;

		$this->render('inscreverse');
	} else if ($usuario->validarCadastro() && count($usuario->getUsuarioPorCpf()) == 0 
		&& count($usuario->getUsuarioPorEmail()) == 0) {
				$usuario->salvar();
				$this->render('entrar');
	} else {
			$this->view->erroCadastro = true;
			
			$this->render('inscreverse');
		}
	}

	public function buscar() {

		$pesquisar = isset($_GET['pesquisar']) ? $_GET['pesquisar'] : '';
		$produtos = array();

		if($pesquisar) {
			$produto = Container::getModel('Produto');
			$produto->__set('modelo', $pesquisar);
			$produtos = $produto->getAllProduct();

			foreach ($produtos as &$p) {
				$valor_numerico = $p['valor_numerico'];
				$p['valor_parcelado'] = $this->parcelas($valor_numerico, 6);
				$imgData = $p['img_prod'];
				$p['imgConvertida'] = 'data:image/jpeg;base64,' . base64_encode($imgData);
			}
		}
		
		$this->view->produtos = $produtos;
    $this->render('buscar');
  }

	public function produtosIndex() {

		$produtoByCategoria = isset($_GET['categoria']) ? $_GET['categoria'] : null;

		$produto = Container::getModel('Produto');
		$produtoCategoria = $produto->getProductByCategory($produtoByCategoria);

		foreach ($produtoCategoria as &$p) {
			
			$valor_numerico = $p['valor_numerico'];
			$p['valor_parcelado'] = $this->parcelas($valor_numerico, 6);
			$imgData = $p['img_prod'];
			$p['imgConvertida'] = 'data:image/jpeg;base64,' . base64_encode($imgData);
		}

		$this->view->produtoCategoria = $produtoCategoria;
		$this->render('produtosIndex');
	}
}


?>
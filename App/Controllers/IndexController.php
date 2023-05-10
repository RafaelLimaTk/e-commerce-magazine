<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$produto = Container::getModel('Produto');
		$produtos = $produto->getAll();

		// echo '<pre>';
		// print_r($produtos);
		// echo '</pre>';

		foreach ($produtos as &$p) {
			$valor_numerico = $p['valor_numerico'];
			$p['valor_parcelado'] = $this->parcelas($valor_numerico, 6);
		}
	
		$this->view->produtos = $produtos;
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

		$this->view->erroCadastro = false;

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
		
		if ($usuario->validarCadastro() && count($usuario->getUsuarioPorCpf()) == 0) {
				$usuario->salvar();
				$this->render('entrar');
		} else {
			$this->view->erroCadastro = true;
			
			$this->render('inscreverse');
		}
	}
}


?>
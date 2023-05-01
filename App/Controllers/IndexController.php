<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->render('index');
	}

	public function entrar() {

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
		$usuario->__set('senha', $_POST['senha']);
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
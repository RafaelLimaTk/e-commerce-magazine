<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;

class CarrinhoController extends Action {

	public function carrinho() {

		$this->render('carrinho');
	}
}

?>
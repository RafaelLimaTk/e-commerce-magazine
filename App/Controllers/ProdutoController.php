<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;

class ProdutoController extends Action {

	public function produto() {

		$this->render('produto');
	}
}

?>
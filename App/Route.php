<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['entrar'] = array(
			'route' => '/entrar',
			'controller' => 'indexController',
			'action' => 'entrar'
		);

		$routes['inscreverse'] = array(
			'route' => '/inscreverse',
			'controller' => 'indexController',
			'action' => 'inscreverse'
		);

		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		$routes['produto'] = array(
			'route' => '/produto',
			'controller' => 'produtoController',
			'action' => 'produto'
		);

		$routes['carrinho'] = array(
			'route' => '/carrinho',
			'controller' => 'carrinhoController',
			'action' => 'carrinho'
		);

		$this->setRoutes($routes);
	}

}

?>
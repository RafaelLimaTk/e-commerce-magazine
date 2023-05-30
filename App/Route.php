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

		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);
		
		$routes['timeline'] = array(
			'route' => '/timeline',
			'controller' => 'AppController',
			'action' => 'timeline'
		);

		$routes['sair'] = array(
			'route' => '/sair',
			'controller' => 'AuthController',
			'action' => 'sair'
		);

		$routes['produto'] = array(
			'route' => '/produto',
			'controller' => 'AppController',
			'action' => 'produto'
		);

		$routes['buscarProduto'] = array(
			'route' => '/buscarProduto',
			'controller' => 'AppController',
			'action' => 'buscarProduto'
		);

		$routes['buscar'] = array(
			'route' => '/buscar',
			'controller' => 'indexController',
			'action' => 'buscar'
		);

		$routes['produtos'] = array(
			'route' => '/produtos',
			'controller' => 'AppController',
			'action' => 'produtos'
		);

		$routes['produtosIndex'] = array(
			'route' => '/produtosIndex',
			'controller' => 'indexController',
			'action' => 'produtosIndex'
		);

		$this->setRoutes($routes);
	}

}

?>
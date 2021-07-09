<?php

namespace Libraries;

defined('_Sdef') or exit();

class AuthMiddleware extends \Slim\Middleware
{

	protected $config;

	public function __construct($settings = array(), \Libraries\Authclass $auth)
	{
		$defaults = array(
			'routeName' => '/admin'
		);

		$this->config = array_merge($defaults, $settings);

		$this->app = \Slim\Slim::getInstance();
		$this->auth = $auth;
	}

	public function call()
	{

		$this->app->hook('slim.before.dispatch', array($this, 'onBeforeDispatch'));

		$this->next->call();
	}

	public function onBeforeDispatch()
	{

		$resource = $this->app->router->getCurrentRoute()->getPattern();

		if ($resource == $this->config['routeName']) {
			if (!$user = $this->auth->isUserLogin()) {
				$this->app->flash('error', 'Доступ запрещен');
				$this->app->redirect($this->app->urlFor('login'));
			}
		}
	}
}

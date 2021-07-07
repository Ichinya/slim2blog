<?php

namespace Controller;

defined('_Sdef') or exit();

abstract class ADisplayController extends AController
{

	protected function getMenu()
	{
		$pages = $this->model->getPages();
		return $this->app->view->fetch('menu.tpl.php', array(
			'pages' => $pages,
			'app' => $this->app
		));
	}

	protected function getSidebar()
	{
	}

	protected function display()
	{
		$menu = $this->getMenu();
	}
}

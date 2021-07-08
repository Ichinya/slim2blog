<?php

namespace Controller;

defined('_Sdef') or exit();

class IndexController extends ADisplayController
{


	public function execute($param = array())
	{

		return $this->display();
	}


	protected function display()
	{


		$this->title .= 'HOME';
		$this->keywords = 'Главная';
		$this->description = 'Главная страница';

		$this->mainbar = 'hello';

		parent::display();
	}
}

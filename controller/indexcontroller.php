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
		parent::display();
	}
}

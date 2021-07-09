<?php

namespace Controller;

defined('_Sdef') or exit();

class AdminController extends ADisplayController
{

	protected function display($tmpl = FALSE)
	{

		parent::display($tmpl);
	}


	public function execute($param = array())
	{

		return $this->display();
	}
}

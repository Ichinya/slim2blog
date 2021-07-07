<?php

namespace Model;

defined('_Sdef') or exit();

class Model
{

	public $driver;

	public function __construct()
	{
		$this->driver = new \Model\Amodel;
	}

	public function getPages()
	{
		$sql = "SELECT `id`,`title`,`alias`
				FROM `" . PREF . "pages`
		";

		if ($this->driver instanceof AModel) {
			$result = $this->driver->query($sql);
		}
		if (!$result) {
			return FALSE;
		}

		return $result;
	}
}

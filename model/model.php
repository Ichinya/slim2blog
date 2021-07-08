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

	public function getCategories()
	{
		$sql = "SELECT `id`,`name`,`alias`
				FROM `" . PREF . "categories`
		";

		if ($this->driver instanceof AModel) {
			$result = $this->driver->query($sql);
		}
		if (!$result) {
			return FALSE;
		}

		return $result;
	}

	public function getNews()
	{
		$sql = "SELECT `id`,`title`,`alias`,`anons`,`date`
				FROM `" . PREF . "news`
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

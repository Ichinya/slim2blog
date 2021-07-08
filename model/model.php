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

	public function getItems($page, $alias = FALSE)
	{

		$where = $alias ? "`" . PREF . "content`.`id_cat` = (SELECT id FROM `" . PREF . "categories` WHERE `alias` = '" . $alias . "')" : FALSE;

		/*$sql = "SELECT `".PREF."content`.`id`,`title`,`introtext`,`images`,`".PREF."categories`.`name` AS `category`,`".PREF."categories`.`alias` AS `alias_cat`,`".PREF."content`.`alias`,`date` FROM `".PREF."content` LEFT JOIN `".PREF."categories` ON `".PREF."categories`.`id` = `".PREF."content`.`id_cat`
		WHERE "`".PREF."content`.`id_cat` = (SELECT id FROM `".PREF."categories` WHERE `alias` = '".$alias."')	
		";*/

		$pager = new \Libraries\Pager(
			$page,
			"`" . PREF . "content`.`id`,`title`,`introtext`,`images`,`" . PREF . "categories`.`name` AS `category`,`" . PREF . "categories`.`alias` AS `alias_cat`,`" . PREF . "content`.`alias`,`date`",
			"`" . PREF . "content`",
			$where,
			" LEFT JOIN `" . PREF . "categories` ON `" . PREF . "categories`.`id` = `" . PREF . "content`.`id_cat`",
			QUANTITY,
			QUANTITY_LINKS,
			$this->driver
		);
		$result = array();
		$result['items'] = $pager->get_posts();
		$result['navigation'] = $pager->get_navigation();

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

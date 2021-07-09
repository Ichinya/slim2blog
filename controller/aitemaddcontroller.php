<?php

namespace Controller;

defined('_Sdef') or exit();

class AitemaddController extends AdmindisplayController
{

	protected $post;

	protected function display($tmpl = FALSE)
	{


		$this->title .= 'Новый материал';

		$categories = $this->model->getCategories();

		$this->mainbar = $this->app->view()->fetch('admin_itemadd.tpl.php', array(
			'categories' => $categories,
			'url' => $this->app->urlFor('aitem_add'),
			'post' => $post,
			'title' => $this->title
		));

		parent::display($tmpl);
	}


	public function execute($param = array())
	{

		$post = $this->app->request->post();

		if ($this->app->request->isPost()) {
			//save
		}

		return $this->display();
	}
}

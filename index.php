<?php
define('_Sdef', TRUE);

session_start();

require_once "vendor/autoload.php";
require 'config.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
	'templates.path' => __DIR__ . '/templates',
	'debug' => TRUE
));

function my_autoload($className)
{
	$baseDir = __DIR__;

	$fileName = $baseDir . DIRECTORY_SEPARATOR;
	$namespace = '';
	if ($lastNsPos = strripos($className, '\\')) {
		$namespace = substr($className, 0, $lastNsPos);
		$className = substr($className, $lastNsPos + 1);
		$fileName .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
	}

	$fileName .= strtolower($className) . '.php';
	if (file_exists($fileName)) {
		require $fileName;
	}
}

spl_autoload_register('my_autoload');

/*$app->add(new \Libraries\AuthMiddleware(
					array('routeName'=>'/admin'),
					\Libraries\Authclass::getInstance(new \Model\AModel),
					\Libraries\Aclclass::getInstance()
										));	*/






$app->get('/(:page)', function ($page = FALSE) use ($app) {

	$o = \Controller\AController::getInstance('index'); //IndexController
	$o->execute(array('page' => $page));
})->conditions(array('page' => '\d+'))->name('home');


$app->get('/page/:alias', function ($alias) use ($app) {

	$o = \Controller\AController::getInstance('page'); //PageController
	$o->execute(array('alias' => $alias));
})->name('page');

$app->get('/item/:alias', function ($alias) use ($app) {

	$o = \Controller\AController::getInstance('item'); //ItemController
	$o->execute(array('alias' => $alias));
})->name('item');

$app->get('/category/:alias(/:page)', function ($alias, $page = FALSE) use ($app) {

	$o = \Controller\AController::getInstance('category'); //CategoryController
	$o->execute(array('alias' => $alias, 'page' => $page));
})->name('category');

$app->get('/new/:alias', function ($alias) use ($app) {

	$o = \Controller\AController::getInstance('news'); //NewsController
	$o->execute(array('alias' => $alias));
})->name('news');

//GET
//POST
$app->map('/login', function () {

	$o = \Controller\AController::getInstance('login'); //NewsController
	$o->execute();
})->via('GET', 'POST')->name('login');


$middle = function () {
	$obj = new \Libraries\AuthMiddleware(
		array('routeName' => '/admin'),
		\Libraries\Authclass::getInstance(new \Model\AModel),
		\Libraries\Aclclass::getInstance()
	);
	return $obj->onBeforeDispatch();
};


$app->group('/admin', $middle, function () use ($app) {

	//  /admin(/:page)
	$app->get('(/:page)', function ($page = 1) {
		$o = \Controller\AController::getInstance('admin'); //AdminController
		$o->execute();
	})->conditions(array('page' => '\d+'))->name('aitems');
});




$app->run();

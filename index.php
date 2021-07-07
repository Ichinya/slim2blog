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


$app->get('/(:page)', function ($page = FALSE) use ($app) {

    $o = \Controller\AController::getInstance('index'); //IndexController
    $o->execute(array('page' => $page));
})->conditions(array('page' => '\d+'))->name('home');



$app->run();

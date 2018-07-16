<?php

//Inicio de errores php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

include_once '../config.php';

$route = $_GET['route'] ?? '/';

use Phroute\Phroute\RouteCollector;

$router = new RouteCollector();
$router->get('/', function() use ($pdo){
	//return 'Route /';
	$sql = "SELECT * FROM blog_post ORDER BY id DESC";
	$query = $pdo->prepare($sql);
	$query->execute();
	$blogPosts = $query->fetchAll(PDO::FETCH_ASSOC);
	include '../views/index.php';
});

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $route);

echo $response;



/*switch ($route) {
	case '/':
		require '../index.php';
		break;
	case '/admin':
		require '../admin/index.php';
		break;
	case '/admin/posts':
		require '../admin/posts.php';
		break;
	default:
		# code...
		break;
}*/


?>
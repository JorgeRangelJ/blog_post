<?php

//Inicio de errores php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

include_once '../config.php';

// la bese url
// $baseUrl = '';
// Directorio base
$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
// host dominio
$baseUrl = 'http://'. $_SERVER['HTTP_HOST']. $baseDir;
// Almacenamos en una constante
define('BASE_URL', $baseUrl);

$route = $_GET['route'] ?? '/';

function render($fileName, $params = [])
{
	ob_start();
	extract($params);
	include $fileName;
	return ob_get_clean();
}

use Phroute\Phroute\RouteCollector;

$router = new RouteCollector();

// Ruta admin
$router->get('/admin', function(){
	return render('../views/admin/index.php');	
});
// Listado de post
$router->get('/admin/posts', function() use ($pdo) {
	$sql = "SELECT * FROM blog_post ORDER BY id DESC";
	$query = $pdo->prepare($sql);
	$query->execute();
	$blogPosts = $query->fetchAll(PDO::FETCH_ASSOC);	
	return render('../views/admin/posts.php', ['blogPosts' => $blogPosts]);
});
// Crear posts
$router->get('/admin/posts/create',  function() {
	return render('../views/admin/insert-post.php');
});

$router->post('/admin/posts/create',  function() use ($pdo) {

		$sql = "INSERT INTO blog_post (title, content) VALUES (:title, :content)";
		$query = $pdo->prepare($sql);
		$result = $query->execute([
						'title' => $_POST['title'],
						'content' => $_POST['content']
						]);

	return render('../views/admin/insert-post.php', ['result' => $result]);
});

$router->get('/', function() use ($pdo){
	//return 'Route /';
	$sql = "SELECT * FROM blog_post ORDER BY id DESC";
	$query = $pdo->prepare($sql);
	$query->execute();
	$blogPosts = $query->fetchAll(PDO::FETCH_ASSOC);
	return render('../views/index.php', ['blogPosts' => $blogPosts]);
	//include '../views/index.php';
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
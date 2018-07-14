<?php

	include_once 'config.php';
	$sql = "SELECT * FROM blog_post ORDER BY id DESC";
	$query = $pdo->prepare($sql);
	$query->execute();
	$blogPosts = $query->fetchAll(PDO::FETCH_ASSOC);

	/*echo "<pre>";
	print_r($blogPost);*/

?>

<!DOCTYPE html>
<html>
<head>
	<title>BLOG | PDO</title>
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Blog PHP</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<?php foreach ($blogPosts as $blog): ?>
					<div class="blog-post">
						<h2><?= $blog['title'] ?></h2>
						<p>
							Jan 1, 2020 by <a href="#">Jorge</a>
						</p>
						<div class="blog-post-image">
							<img src="images/img_blog.jpg"alt="">
						</div>
						<div class="blog-post-content">	
							<?= $blog["content"] ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="col-md-4">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
		</div>
		<div class="row">
			<footer>
				This is Foother
			</footer>
		</div>
	</div>
</body>
</html>
<?php

	$result = false;

	if (!empty($_POST)) 
	{
		$sql = "INSERT INTO blog_post (title, content) VALUES (:title, :content)";
		$query = $pdo->prepare($sql);
		$result = $query->execute([
						'title' => $_POST['title'],
						'content' => $_POST['content']
						]);
	}


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
				<h2>New Posts</h2>
				<p>
					<a class="btn btn-default" href="posts.php">Back</a>	
				</p>
				<?php if ($result) { ?>
					<div class="alert alert-success">Post Saved!!!</div>
				<?php } ?>
				<form action="insert-post.php" method="post">
					<div class="form-group">
						<label for="inputTitle">Title</label>
						<input class="form-control" type="text" name="title" id="inputTitle">
						<label for="inputContent">Content</label>
						<textarea class="form-control" name="content" id="inputContent" rows="5"></textarea>			
						<br>
						<input class="btn btn-primary" type="submit" value="Save">			
					</div>
				</form>
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
			<div class="col-md-12">
				<footer>
					This is Foother<br>
					<a href="admin/index.php">Admin Panel</a>
				</footer>
			</div>
		</div>
	</div>
</body>
</html>
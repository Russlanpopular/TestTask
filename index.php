<?php

	session_start();

	require_once('/models/Posts.php');
	//$_SESSION['user']='Admin';
?>
<!DOCTYPE html>
<html lang="en">

	

	<meta charset="UTF-8">
	<title>Index</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="style/main.css">
</head>
<body>
<div class="content">
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <span class="navbar-brand"> <?php if(isset($_SESSION['user'])){echo $_SESSION['user'];}else{echo "Гость";}?></span>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="/">Home</a></li>

	    </ul>
	    <ul class="nav navbar-nav navbar-right">
		    <?php if(isset($_SESSION['user'])) { ?>
				<li><a href="/test/views/login.php?logout=1"><span class="glyphicon glyphicon-log-in"></span> Logout </a></li>
			<?php }else{ ?>
		      <li><a href="/test/views/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		    <?php } ?>
	    </ul>
	  </div>
	</nav>
	<div class="container">

		<?php 

			$posts = new Posts();

	    	$AllPosts = $posts->getAllPosts();

		    foreach ($AllPosts as $post) { ?> 
		      <div class="alert alert-info">
		        <strong><?=htmlspecialchars($post['title'])?></strong>
		        <p><?=htmlspecialchars($post['text'])?></p>
		      </div>
		   <?php } ?>

		   <?php
		      if(isset($_POST['submit'])){
		        $title =  $_POST['title'];
		        $message =  $_POST['message'];

		       $posts->addPost($title, $message);
		      }
		   ?>

	<?php 
		if(((isset($_SESSION['user'])) && $_SESSION['user']=="Admin")){ ?>
		<div class="col-md-6 col-md-offset-3">
		  <div class="write-post">
		    <form  method="post">
		        <div class="form-group">
		          <label for="title">Title</label>
		          <input type="text" class="form-control" name="title" id="title" required="">
		        </div>
		        <div class="form-group">
		            <textarea name="message" class="col-md-12" rows="10" id="message" required="" placeholder="Введите ваше сообщение"></textarea>
		        </div>
		        <button type="submit" name="submit" class="btn btn-success">Добавить пост</button>
		    </form>
		  </div>
		</div>
		<?php }else{ ?>

			<p class = "text-warning text-center" >Для того, чтобы запостить сообщение залогиньтесь на сайте <a href="views/login.php">Login</a></p>
			<?php } ?>
	</div>

</div>
	<footer class="navbar navbar-default">
		<div class="container">
			<div class="text-center">
				<p>Copyright &copy; 2016</p>
			</div>
		</div>
	</footer>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/common.js"></script>
</body>
</html>
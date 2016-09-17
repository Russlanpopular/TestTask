<?php
	session_start();

	if(isset($_GET['logout']) && $_GET['logout']==1){
		unset($_SESSION["user"]);
		session_destroy(); 
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	

	<meta charset="UTF-8">
	<title>Index</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style/main.css">
</head>
<body>
	<div class="content">
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <span class="navbar-brand"> <?php if(isset($_SESSION['user'])){echo $_SESSION['user'];}else{echo "Гость";}?></span>
		    </div>
		    <ul class="nav navbar-nav">
		      <li class="active"><a href="/test">Home</a></li>

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
		   <?php
		      if(isset($_POST['signin'])){
		        $login =  trim($_POST['login']);
		        $password =  trim($_POST['password']);
		        	if($login == "Admin" && $password == "admin"){
						$_SESSION['user']='Admin';
						header( 'Location: /test', true, 307 );
		        	}
		      }
		   ?>
		<div class="container">
			<div class="col-md-6 col-md-offset-3">
				<form class="login-form" method="post" action="/test/views/login.php">
				  <div class="form-group">
				    <label for="login">Login</label>
				    <input type="text" class="form-control" name="login" id="login">
				  </div>
				  <div class="form-group">
				    <label for="pwd">Password:</label>
				    <input type="password" class="form-control" name="password" id="pwd">
				  </div>
				  <button type="submit" name="signin" class="btn btn-default">login</button>
				</form>
				<p class="text-info text-center">login=>'Admin', password=>'admin'</p>
			</div>
		</div>
	</div>
	<footer class="navbar navbar-default">
		<div class="container">
			<div class="text-center">
				<p>Copyright &copy; 2016</p>
			</div>
		</div>
	</footer>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
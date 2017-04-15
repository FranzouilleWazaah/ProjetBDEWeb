<?php
require_once ("class/user.php");
require_once("session.php");
	
	$auth_user = new USER();
	
	
	$id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM utilisateur WHERE id=:id");
	$stmt->execute(array(":id"=>$id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="web design responsive">
	<title>BDE CESI - Lyon</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<header>
		
		<div id="branding">
			<img src="img/logo_bde.png">
		</div>
		<nav>
			<ul>
				<li class="current"><a href="">Home</a></li>
				<li><a href="">Calendar</a></li>
				<li><a href="">Photos</a></li>
				<li><a href="">Shop</a></li>
			</ul>
		</nav>
		</div>
	</header>
	<label><a href='logout.php'><i class="glyphicon glyphicon-log-out"></i> Log out</a></label>
	<section>
		<div class="content">
		welcome : <?php print($userRow['username']); ?>
		</div>
		
	</section>


</body>
</html>

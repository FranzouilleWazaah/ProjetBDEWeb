<?php
require_once ("class/user.php");
require_once("session.php");
	
	$auth_user = new USER();
	
<<<<<<< HEAD

	$id = $_SESSION['user_session'];

=======
	
	$id = $_SESSION['user_session'];
	
>>>>>>> origin/master
	$stmt = $auth_user->runQuery("SELECT * FROM utilisateur WHERE id=:id");
	$stmt->execute(array(":id"=>$id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>

<<<<<<< HEAD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
=======
<<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
>>>>>>> origin/master
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
<<<<<<< HEAD


=======
>>>>>>> origin/master
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
<<<<<<< HEAD
			<img src="img/logo_bde.png" width="250px" height="250px">
		</div>
		<?php 
    include 'avatar.php';
      ?>
		<nav>
			<ul>
				<li class="current"><a href="home.php">Home</a></li>
				<li><a href="gallery/gallery.php">Photos</a></li>
				<li><a href="boutique.php">Shop</a></li>
				<li><a href="contact.php">Contact us</a></li>
				<?php // Displays the tab if the user has the correct permission

				if ($_SESSION['permissions']=='cesiMember')
				{
					echo '<li><a href="gallery/admin/index.php">Manage photos</a></li>';
				}

				?>

				<?php // Displays the tab if the user has the correct permission

				if ($_SESSION['permissions']=='bdeMember')
				{
					echo '<li><a href="index-admin.php">Administration</a></li>';
				}

				?>

=======
			<img src="img/logo_bde.png">
		</div>
		<nav>
			<ul>
				<li class="current"><a href="">Home</a></li>
				<li><a href="">Calendar</a></li>
				<li><a href="">Photos</a></li>
				<li><a href="">Shop</a></li>
>>>>>>> origin/master
			</ul>
		</nav>
		</div>
	</header>
<<<<<<< HEAD
	<section>
		
		
	</section>
<?php echo $row['permissions'];
?>
	<div class="container">
		<div id="wrapper">
	
       	 <?php
            try {
                $stmt = $auth_user->runQuery("SELECT postID, postTitle, postDesc, postDate, eve_date FROM blog_posts ORDER BY postID DESC");
                $stmt->execute();
                while($row = $stmt->fetch()){
                    extract($row);
                    echo '<div>';
                        echo '<h1><a href="viewpost.php?id='.$row['postID'].'">'.$row['postTitle'].'</a></h1>';
                        echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).'</p>';
                        echo '<p>'.$row['postDesc'].'</p>';  
                        echo '<p> évènement le '.$row['eve_date'].'</p>';          
                        echo '<p><a href="viewpost.php?id='.$row['postID'].'">Read More</a></p>';               
                    echo '</div>';
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        ?>
    	</div>
    </div>
    <footer>
		<div class="container">
			<p>BDE CESI - Lyon, Copyright &copy; 2017</p>
		</div>
		
=======
	<label><a href='logout.php'><i class="glyphicon glyphicon-log-out"></i> Log out</a></label>
	<section>
		<div class="content">
		welcome : <?php print($userRow['username']); ?>
		</div>
		
	</section>


>>>>>>> origin/master
</body>
</html>

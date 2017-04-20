<?Php
include 'check.php';

////////////////////////////////////////////
require "../config.php"; // Database connection 
///////////////////////////







require "../../session.php";
$auth_user = new USER();
  $id = $_SESSION['user_session'];
?>

<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>(Type a title for your page here)</title>
<script src='gallery.js'></script>
<link rel="stylesheet" href="../../css/style.css" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body onLoad=ajaxFunction('none');>

<header>
		<div id="branding">
			<img src="../../img/logo_bde.png" width="250px" height="250px">
		</div>
	
	<?php 
    
    $id = $_SESSION['user_session'];
    $stmt = $auth_user->runQuery("SELECT id, username, userPic FROM utilisateur WHERE id=:id");
    $stmt->execute(array(":id"=>$id));

    if($stmt->rowCount() > 0)
  {
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
      extract($row);
      ?>
      <div id="Avatar">
      <h4 style="color:black"><?php echo '<b> Welcome &nbsp;'.$username."&nbsp; </b>" ?>
      &nbsp;<img src="../../user_images/<?php echo $row['userPic']; ?>" class="img-rounded" width="75px" height="65px" />
      <br><a href='../../logout.php'><button class='button-logout'> Log out</button></a>
      </div>
      <?php
    }
  }
      
      ?>
    <nav>
     <ul>
				<li><a href="../../home.php">Home</a></li>
				<li><a href="../gallery.php">Photos</a></li>
				<li><a href="../../boutique.php">Shop</a></li>
				<li><a href="../../contact.php">Contact us</a></li>
				<?php // Displays the tab if the user has the correct permission

				if ($_SESSION['permissions']=='cesiMember')
				{
					echo '<li class="current"><a href="index.php">Manage photos</a></li>';
				}

				?>

				<?php // Displays the tab if the user has the correct permission

				if ($_SESSION['permissions']=='bdeMember')
				{
					echo '<li><a href="index-admin.php">Administration</a></li>';
				}

				?>

			</ul>
			</nav>
        </header>
       <footer>
       <div class="container">
            <p>BDE CESI - Lyon, Copyright &copy; 2017</p>
       
        
    </footer>


</html>
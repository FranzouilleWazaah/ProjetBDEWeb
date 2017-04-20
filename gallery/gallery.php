<?php
require 'menu.php';   
require "config.php"; // Database Connection
require "../class/user.php";
require "../session.php";

  $userid= $_SESSION['user_session'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">


  <meta name="description" content="web design responsive">
  <title>BDE CESI - Lyon</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src='gallery.js'></script>
</head>

<body onLoad=ajaxFunction('none');>

<header>
		<div id="branding">
			<img src="../img/logo_bde.png" width="250px" height="250px">
		</div>
	
	<?php 
    
    $stmt = $session->runQuery("SELECT id, username, userPic FROM utilisateur WHERE id=:id");
    $stmt->execute(array(":id"=>$userid));

    if($stmt->rowCount() > 0)
  {
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
      extract($row);
      ?>
      <div id="Avatar">
      <h4 style="color:black"><?php echo '<b> Welcome &nbsp;'.$username."&nbsp; </b>" ?>
      &nbsp;<img src="../user_images/<?php echo $row['userPic']; ?>" class="img-rounded" width="75px" height="65px" />
      <br><a href='../logout.php'><button class='button-logout'> Log out</button></a>
      </div>
      <?php
    }
  }
      
      ?>
    <nav>
     <ul>
				<li><a href="../home.php">Home</a></li>
				<li class="current"><a href="gallery.php">Photos</a></li>
				<li><a href="../boutique.php">Shop</a></li>
				<li><a href="../contact.php">Contact us</a></li>
				<?php // Displays the tab if the user has the correct permission

				if ($_SESSION['permissions']=='cesiMember')
				{
					echo '<li><a href="admin/index.php">Manage photos</a></li>';
				}

				?>

				<?php // Displays the tab if the user has the correct permission

				if ($_SESSION['permissions']=='bdeMember')
				{
					echo '<li><a href="../index-admin.php">Administration</a></li>';
				}

				?>

			</ul>
			</nav>
        </header>
<div class="container">
<?php


echo "<br><br><br><div id=\"msgDsp\" STYLE=\"text-align:left; FONT-SIZE: 12px;font-family: Verdana;border-style: solid;border-width: 1px;border-color:white;padding:10px;height:40px;width:200px;top:10px;z-index:1\"> Add Gallery</div>";


echo "<form method=post name=f1 action=''>
<table class='t1'>";
echo "<tr class='r0'><td><input type=text name=gallery><input type=button onClick=ajaxFunction('add_gal') value='Add Gallery'></td></tr>";
echo "</table>
</form>";


echo "<div id=\"record-display\" STYLE=\"text-align:left; FONT-SIZE: 12px;font-family: Verdana;border-style: solid;border-width: 1px;border-color:white;padding:10px;height:40px;width:800px;top:10px;z-index:1\"> </div>";



?>
</div>
</body>

<footer>
       <div class="container">
            <p>BDE CESI - Lyon, Copyright &copy; 2017</p>
       
        
    </footer>


</html>

<?php
require 'menu.php';   
require "config.php"; // Database Connection
require "../session.php";
$auth_user = new USER();
  $id = $_SESSION['user_session'];
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
</head>
<body>

<header>
		<div id="branding">
			<img src="../img/logo_bde.png" width="250px" height="250px">
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
echo "<form action='uploadck.php' method=post target='myiframe' enctype='multipart/form-data' >
<input type=hidden name=todo value='upload'>
<br><br><br>
<table border='0' width='770' cellspacing='0' cellpadding='0'>
<tr ><td width =10></td><td class='data'> Select Gallery for your photos  </td><td>
";
echo "<select name='gal_id'><option value=''>Gallery</option>";
$nt="select * from plus2net_gallery  order by gallery";

foreach ($dbo->query($nt) as $rt) {
echo "<option value='$rt[gal_id]' >$rt[gallery]</option>";
}

echo "</select></td></tr>
</table>
<table border='0' width='770' cellspacing='0' cellpadding='0'>

<tr bgcolor='#f1f1f1'><td class='data'>Images</td><td>
<input type=file name='userfile[]' multiple><input type=submit value='Upload Image'></td></tr>

</table>

</td></tr>
<tr><td width =10></td></tr>
</table>
</form>
";


echo "<iframe name='myiframe' src='uploadck.php' width=\"1000\" height=\"600\" frameBorder=\"0\"> 
</iframe>";

?>
</div>
</body>

<footer>
       <div class="container">
            <p>BDE CESI - Lyon, Copyright &copy; 2017</p>
       
        
    </footer>


</html>










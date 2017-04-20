<?php
require "../../session.php";
$auth_user = new USER();
  $id = $_SESSION['user_session'];


include 'check.php';
require "../config.php"; // Database connection 




?>


<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>BDE CESI - Lyon</title>
<script src='gallery.js'></script>
<link rel="stylesheet" href="../../css/style.css" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body onLoad=ajaxFunction('none');>

<header>
		<div id="branding">
			<img src="../../img/logo_bde.png" width="250px" height="250px">
		</div>
		<script LANGUAGE=\"JavaScript\"> 
<!-- 
function confirmSubmit(table_name,todo) {
var msg;
msg= \"Are you sure you want to \" + todo + \" \" + table_name  + \"?\";"
var agree=confirm(msg);
if (agree)
return true ;
else
return false ;
}
// -->
</script>
	
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
					echo '<li><a href="index.php">Manage photos</a></li>';
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
        <br><br><br>
        <?php
@$todo=$_GET['todo'];
if($todo=='delete_gal')
{
$gal_id=$_GET['gal_id'];
if(!is_numeric($gal_id)){
echo "Data Error";
exit;
}
//// delete photos
$sql="select file_name from plus2net_image where gal_id=$gal_id";
foreach ($dbo->query($sql) as $row) {
$add = "../$path_upload".$row['file_name'];
unlink($add);
$add = "../$path_thumbnail".$row['file_name'];
unlink($add);
}
/// delete records  from plus2net_image 
$count=$dbo->prepare("delete from plus2net_image where gal_id=$gal_id");
$count->execute();
//// Delete record from plus2net_gallery

$count=$dbo->prepare("delete from plus2net_gallery where gal_id=$gal_id");
$count->execute();


}// end of if 

///// end of deleting gallery and images////

$sql="select count(plus2net_image.img_id) as no,gallery,plus2net_gallery.gal_id from plus2net_gallery left join plus2net_image on plus2net_gallery.gal_id=plus2net_image.gal_id  where NOT  ISNULL( plus2net_gallery.gal_id) group by plus2net_gallery.gal_id";
$i=1;
echo "<table class='t1'>";
foreach ($dbo->query($sql) as $row) {$m=$i%2;
echo "<tr class='r$m'><td>$row[gal_id]</td><td>$row[gallery]($row[no])</td><td><a onclick=\"return confirmSubmit('$row[gallery]','delete gallery')\" href='manage-gallery.php?gal_id=$row[gal_id]&todo=delete_gal'><img src='../del.jpg'></a></td></tr>";
$i=$i+1;}
echo "</table>";
///////// End of display /////////
?>
</div>
	<footer>
       <div class="container">
            <p>BDE CESI - Lyon, Copyright &copy; 2017</p>
       
        
    </footer>


</html>




















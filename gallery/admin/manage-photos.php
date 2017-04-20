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
		<SCRIPT language=JavaScript>
function reload(form){
/*
for(var i=0; i < document.f1.no_title.length; i++){
if(document.f1.no_title[i].checked)
var val2=document.f1.no_title[i].value
}
*/
var val=document.f1.gal_id.options[document.f1.gal_id.options.selectedIndex].value;
//self.location='manage-photos.php?gal_id=' + val + '&no_title=' + val2;
self.location='manage-photos.php?gal_id=' + val;

}
////////////////// Ajax starts ///////////////////////////////
function ajaxFunction(post_id,todo)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateChanged() 
{
if(httpxml.readyState==4)
{
//alert(httpxml.responseText);

var myObject = eval('(' + httpxml.responseText + ')');

var msg=myObject.value[0].message
if(msg.length > 0){document.getElementById("msg").style.background='#ffff00';
document.getElementById("msg").innerHTML=msg;
setTimeout("document.getElementById('msg').style.display='none'",2000)}
else{document.getElementById("msg").style.display='none';}
var post_id=myObject.value[0].post_id
var t2=post_id+"title";
var b2=post_id+"button";
if(myObject.value[0].status=="success"){
document.getElementById(t2).innerHTML=myObject.value[0].title;
document.getElementById(b2).innerHTML="<input type=button onClick=editnow(" + post_id + ") value=Edit>";
}

}
}
var url="manage-photosck.php";
url=url+"?post_id="+post_id;
url=url+"&todo="+todo;
if(todo=="update"){
var t2=post_id+"title2";
url=url+"&dtl="+document.getElementById(t2).value;
}

url=url+"&sid="+Math.random();
//alert(url);
//alert(document.getElementById(t2).value);
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
document.getElementById("msg").style.background='#ff00ff';
document.getElementById("msg").innerHTML="Please Wait... ";
}
////////////////////////////////////////


/////////////////  Ajax ends ///////////////////////////
////////////////////////////////////////
function editnow(id){
var t=id+"title";
var b=id+"button";
document.getElementById(t).innerHTML="<input type=text id="+t+"2 name="+t+" size=30 value='"+document.getElementById(t).innerHTML+"'>";
document.getElementById(b).innerHTML="<input type=button value=Update onClick=ajaxFunction("+id+",'update')>";
var t4=id + "title2";
document.getElementById(t4).focus();
//var b1=id + "button";
//document.getElementById(b1).style.display='none';
}
///////////////////////////////////
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


<?Php



@$start=$_GET['start'];
@$pd=$_GET['pd'];
@$msg=$_GET['msg'];
$userid = $_SESSION['user_session'];// Replace with your userid 

if($pd=="msg_show"){echo "<SPAN STYLE=\"background: #ffff00; font: Arial 10pt;\">$msg</span>";}


if(!isset($start)) { 
$start = 0;
}

$eu = ($start - 0); 
$limit = 10;          // No of records to be shown per page.
$this1 = $eu + $limit; 
$back = $eu - $limit; 
$next = $eu + $limit; 
$pro = $next + 1; 
$ant = $back + 1; 

@$gal_id=$_GET['gal_id'];
if($gal_id > 0 ){
$query=" select * from plus2net_image where gal_id=$gal_id  order by img_id desc limit $eu,$limit";
$query2=" select count(img_id) from plus2net_image where  gal_id=$gal_id ";

}else{
$query=" select * from plus2net_image  order by img_id desc limit $eu,$limit";
$query2=" select count(img_id) from plus2net_image  ";
}

  //$result=mysql_query($query);  
//$result2=mysql_query($query2);
//echo $query;

$nume = $dbo->query($query2)->fetchColumn();
//echo $nume;
echo "<table border='0' width='100%' cellspacing='0' cellpadding='0'>";
$i=1;
echo "<tr>";
echo "<form action='manage-photosck.php' method=post ><input type=hidden name=todo value='delete_img'>";
foreach ($dbo->query($query) as $nt) {
if($i >=4){echo "</tr><tr>";$i=1;}
$id=$nt['img_id'];
$img=$nt['file_name'];
echo "<td class='data'  width='300' height='170' valign=top><a href='gallery/photo.php?id=$id' target='new'><img src='../$path_thumbnail$img' border=0></a><br>
<div id=$id"."title>$nt[title]</div>
<div id=$id"."button><input type=button  onClick=editnow([$id]); value='Edit'></div> <img src=../del.jpg onClick=ajaxFunction($id,'Delete') align=righ>

</td>";
$i = $i+1;
}
///<img src='$path_thumbnail$img' border=0>
echo "</table></form>";


echo "<table align = 'center' width='100%'><tr><td  class='data' width='20%'>";
if($ant >= 1) { 
print "<a href='manage-photos.php?start=$back&gal_id=$gal_id&'>PREV</a>"; 
} 
echo "</td><td class='data' align=center width='60%'>";
$i=0;
$l=1;
for($i=0;$i < $nume;$i=$i+$limit){
if($i <> $eu){
echo " <a href='manage-photos.php?start=$i&gal_id=$gal_id'>$l</a> ";
}
else { echo $l;}
$l=$l+1;
}


echo "</td><td class='data' align='right' width='20%'>";
if($this1 < $nume) { 
print "<a href='manage-photos.php?start=$next&gal_id=$gal_id>NEXT</a>";} 
echo "</td></tr></table>";

$query="SELECT gallery,plus2net_gallery.gal_id FROM  plus2net_gallery left join plus2net_image 
on  plus2net_gallery.gal_id=plus2net_image.gal_id 
where  plus2net_gallery.userid='$userid' group by (plus2net_gallery.gal_id) order by gallery ";

echo "<form name=f1 method=get action=manage-photos.php>";

echo "<select name=gal_id onchange=\"reload(this.form)\">
<option value=0>Select Gallery</option>";
foreach ($dbo->query($query) as $gt) {
if($gt['gal_id']==$gal_id){
echo "<option value=$gt[gal_id] selected>$gt[gallery]</option>";}
else{echo "<option value=$gt[gal_id]>$gt[gallery]</option>";}
}
echo "</select></form>";


//echo mysql_error();
//require "templates/g_sides.php"; echo "</td></tr>";


  
?>
</div>
	<footer>
       <div class="container">
            <p>BDE CESI - Lyon, Copyright &copy; 2017</p>
       
        
    </footer>


</html>




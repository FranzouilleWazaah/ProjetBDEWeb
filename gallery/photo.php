<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>(Type a title for your page here)</title>
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>

<?Php
require "config.php"; // Database Connection
require 'menu.php'; 


//////////////////////////////////////////////////////Gallery //////////////////

$img_id=$_GET['img_id'];
if(!is_numeric($img_id)){
echo "Data Error";
exit;
}
error_reporting(0);// With this no error reporting will be there

$count=$dbo->prepare("select * from plus2net_image where img_id=:img_id");
$count->bindParam(":img_id",$img_id,PDO::PARAM_INT,5);

if($count->execute()){
$gal = $count->fetch(PDO::FETCH_OBJ);
}else{
echo ' Database problem ';
}


$count=$dbo->prepare("select gallery from plus2net_gallery  where  gal_id=:gal_id");
$count->bindParam(":gal_id",$gal->gal_id,PDO::PARAM_INT,5);

if($count->execute()){
$g = $count->fetch(PDO::FETCH_OBJ);
}else{
echo ' Database problem 2';
}

//$top_menu = "<a href=\"$g->f_name\">$g->gal_name</a>";

echo "<!doctype html public \"-//w3c//dtd html 3.2//en\">
<html>
<head>
<title>go2india.in : $g->gallery</title>
<link rel=\"stylesheet\" href=\"style.css\" type=\"text/css\">
</head>
<body>
";
echo "<table border='0' width='100%' cellspacing='0' cellpadding='0'>

<tr><td class=data valign='top'><img src='$path_upload$gal->file_name' alt='$gal->title' border=0>


<br>$gal->title<br>
<br>";
////////// Rating ///////////
echo "<hr size=1 color=green>";


echo "</td>
<td class=data valign=top align=right><font color='#ffffff'>Other images";
echo "<br>";


$count=$dbo->prepare("select img_id,file_name from plus2net_image where img_id > $img_id and gal_id=$gal->gal_id  limit 0,1");
if($count->execute()){
$qt = $count->fetch(PDO::FETCH_OBJ);
}else{
echo ' Database problem ';
}

if($qt){
$next_img=$qt->file_name;
echo "<a href='photo.php?img_id=$qt->img_id'><img src=$path_thumbnail$next_img border=0></a><input type=hidden id='next_img_id' value='$qt->img_id'>";

}else{echo "No next image<br><br><br><br><br><br><input type=hidden id='next_img_id' value=''>";}

echo "<br><hr size=1 color=blue>";

//$qt=mysql_fetch_object(mysql_query("select img_id from photo_img where img_id < $id and gal_id=$gal->gal_id and userid='$gal->userid' order by img_id desc limit  0,1"));
$count=$dbo->prepare("select img_id,file_name from plus2net_image where img_id < $img_id and gal_id=$gal->gal_id  order by img_id desc limit  0,1");
if($count->execute()){
$qt = $count->fetch(PDO::FETCH_OBJ);
}else{
echo ' Database problem ';
}

if($qt){
$prev_img=$qt->file_name;
echo "<a href='photo.php?img_id=$qt->img_id'><img src=$path_thumbnail$prev_img border=0></a>";

}else{echo "No prev image<br><br><br><br><br><br>";}

echo "</td>
<tr></table>

";
?>
</body>
</html>

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
require "../session.php";

//////////////////////////////////////////////////////Gallery //////////////////

@$start=$_GET['start'];
$gal_id=$_GET['gal_id'];
if(!is_numeric($gal_id)){
echo "Data Error";
exit;
}
if(strlen($start) > 0  and !is_numeric($start)){
echo "Data Error";
exit;
}

$count=$dbo->prepare("select * from plus2net_gallery where gal_id=:gal_id");
$count->bindParam(":gal_id",$gal_id,PDO::PARAM_INT,4);
if($count->execute()){
$row = $count->fetch(PDO::FETCH_OBJ);
$gallery=$row->gallery;
}else{
echo " Please check database and gallery table ";
}


echo "<!doctype html public \"-//w3c//dtd html 3.2//en\">

<html>

<head>
<title>$gallery</title>
<link rel=\"stylesheet\" href=\"../images/all11.css\" type=\"text/css\">

</head>

<body  >
";


 if(!isset($start)) { 
$start = 0;
}

$eu = ($start - 0); 
$limit = 32;          // No of records to be shown per page.
$this1 = $eu + $limit; 
$back = $eu - $limit; 
$next = $eu + $limit; 
$pro = $next + 1; 
$ant = $back + 1; 

$query=" select * from plus2net_image where gal_id=$gal_id limit $eu,$limit";
$query2=" select count(img_id) from plus2net_image where gal_id=$gal_id ";

$nume = $dbo->query($query2)->fetchColumn();


echo "<h3>$gallery</h3>
<table border='0' width='100%'>";
$i=1;
echo "<tr>";
foreach ($dbo->query($query) as $nt){
if($i >=6){echo "</tr><tr>";$i=1;}
echo "<td class='data' width=100 valign='top'><a href=\"photo.php?img_id=$nt[img_id]\"><img src='$path_thumbnail$nt[file_name]' border=0></a><br>
$nt[title]<br></td>";
$i = $i+1;
}

echo "</tr></table></div>";

echo "<table align = 'center' width='100%'><tr><td  class='data' width='20%'>";
if($ant >= 1) { 
print "<a href='gallery-photo.php?start=$back&gal_id=$gal_id'>PREV</a>"; 
} 
echo "</td><td class='data' align=center width='60%'>";
$i=0;
$l=1;
for($i=0;$i < $nume;$i=$i+$limit){
if($i <> $eu){
echo " <a href='gallery-photo.php?start=$i&gal_id=$gal_id'>$l</a> ";
}
else { echo $l;}
$l=$l+1;
}


echo "</td><td class='data' align='right' width='20%'>";
if($this1 < $nume) { 
print "<a href='gallery-photo.php?start=$next&gal_id=$gal_id'>NEXT</a>";} 
echo "</td></tr></table>";

/////////////////////// end of gallery with paging ///////////////
  


?>


</body>

</html>

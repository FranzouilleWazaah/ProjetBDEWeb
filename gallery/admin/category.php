<?Php
session_start();
echo "<!doctype html public \"-//w3c//dtd html 3.2//en\">
<html>
<head>
<title>Admin area category section</title>
<META NAME=\"DESCRIPTION\" CONTENT=\" \">
<META NAME=\"KEYWORDS\" CONTENT=\"\">
<link rel=\"stylesheet\" href=\"../style.css\" type=\"text/css\">
</head><body>";
include 'check.php';
echo "<div id=msg style=\"position:absolute; width:300px; height:25px; 
z-index:1; left: 900px; top: 0px; 
 border: 1px none #000000\"></div>";

////////////////////////////////////////////
require "../config.php"; // Database connection 
///////////////////////////
@$todo=$_POST['todo'];
if($todo=='add_cat'){
$category=$_POST['category'];
$sql=$dbo->prepare("insert into plus2net_category(category) values(:category)");
$sql->bindParam(':category',$category,PDO::PARAM_STR, 200);
if($sql->execute()){
$mem_id=$dbo->lastInsertId(); 
}
else{print_r($sql->errorInfo()); }


}
echo "<form method=post name=f1 action=''><input type=hidden name=todo value='add_cat'>
<table class='t1'>";
echo "<tr class='r0'><td>Category Name</td><td><input type=text name=category></td><td><input type=Submit value=submit></tr>";
echo "</table>
</form>";

$sql="SELECT *  FROM `plus2net_category` order by category";

echo "<table class='t1'>";
$i=1;
foreach ($dbo->query($sql) as $row) {$m=$i%2;
echo "<tr class='r$m'><td>$row[cat_id]</td><td>$row[category]</td><td><img src=../del.jpg> </td></tr>";
$i=$i+1;}
echo "</table>";
///////// End of display /////////

echo "</body></html>";
?>




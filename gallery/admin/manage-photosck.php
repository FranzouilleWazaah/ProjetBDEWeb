<?Php
////////////////////////////////////////////
require "../config.php";
///////////////////////////
error_reporting(0);// With this no error reporting will be there

$post_id=$_GET['post_id'];
$todo=$_GET['todo'];
//$post_id=35;
//$todo='Delete';
if(!is_numeric($post_id)){
echo "Data Error";
exit;
}
if($todo=='update'){
$title=$_GET['dtl'];
//$title =" testing ";
$count=$dbo->prepare("update plus2net_image set title=:title where img_id=:post_id");
$count->bindParam(":title",$title,PDO::PARAM_STR,100);
$count->bindParam(":post_id",$post_id,PDO::PARAM_INT,4);
if($count->execute()){
$message=" Updated ";
$status="success";
}else{
$message="Failed to  Update ";
//print_r($dbo->errorInfo());
$status="fail";
 }
}// end of todo
if($todo=='Delete'){
$count=$dbo->prepare("select file_name from plus2net_image where img_id=:post_id");
$count->bindParam(":post_id",$post_id,PDO::PARAM_INT,4);
if($count->execute()){
//echo " Success <br>";
$row = $count->fetch(PDO::FETCH_OBJ);
$file_name=$row->file_name;
//print_r($row);
//echo "<hr><br>Admin = $row->userid";
}

$count=$dbo->prepare("delete from plus2net_image where img_id=:post_id");
$count->bindParam(":post_id",$post_id,PDO::PARAM_INT,4);
if($count->execute()){
$add="../$path_upload$file_name";
unlink($add);
$add="../$path_thumbnail$file_name";
unlink($add);
$message=" Deleted ";
$status="success";
$title='This is DELETED';
}// if mysql_affeted_rows=1
}// if todo == delete


$str="{\"value\" : [{\"message\" :\" $message \",\"status\" :\"$status\",\"post_id\" : $post_id,\"title\" : \"$title\"}]}";
echo $str;



?>

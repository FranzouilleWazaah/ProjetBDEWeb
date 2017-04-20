<?Php
////////////////////////////////////////////
require "config.php";
require "../session.php";
///////////////////////////
@$todo=$_POST['todo'];
$row=array("msg"=>"","status_form"=>"fresh");
switch($todo)
{
case 'add_gal':

$gallery=$_POST['gallery'];

$userid= $_SESSION['user_session'];

error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);


if(strlen($gallery) < 2){
$msg=$msg."Please enter gallery name <BR>"; 
$row["status_form"]="NOTOK";
}


if($row["status_form"]<>"NOTOK"){// echo $query;

$sql=$dbo->prepare("insert into plus2net_gallery(gallery,userid) values(:gallery,:userid)");

$sql->bindParam(':gallery',$gallery,PDO::PARAM_STR, 100);
$sql->bindParam(':userid',$userid,PDO::PARAM_STR, 100);
if($sql->execute()){
$mem_id=$dbo->lastInsertId(); 
$msg .=" Gallery added , ID: $mem_id";
$row["status_form"]="ADDED";
}// if sql executed 
else{print_r($sql->errorInfo()); }
//// status is ok now reply the message ///

} // End of if status is Ok
else{
////// if failes //////////////


//////////end of if fails////////////////////////////////////
}// end of if else checking status

break; // inside switch for adding gallery 

}// end of switch

$sql="select count(plus2net_image.img_id) as no,gallery,plus2net_gallery.gal_id from plus2net_gallery left join plus2net_image on plus2net_gallery.gal_id=plus2net_image.gal_id  where NOT  ISNULL( plus2net_gallery.gal_id) group by plus2net_gallery.gal_id"; 

//$sql="select gal_id,gallery from plus2net_gallery order by gal_id"; 
$row1=$dbo->prepare($sql);
$row1->execute();
$result=$row1->fetchAll(PDO::FETCH_ASSOC);

@$row["msg"]=$msg;
$main = array('data'=>$result,'value'=>array($row)); 
echo json_encode($main); 

?>




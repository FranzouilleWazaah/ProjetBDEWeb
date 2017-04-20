<?Php

////////////////////////////////////////////
require "../config.php"; // Database connection 
///////////////////////////
$email_id=$_GET['email_id'];
$todo=$_GET['todo'];
$status=$_GET['status'];

if(!is_numeric($email_id)){
echo "Data Error";
exit;
}

$message=$todo; // 
$db_status='';              // Set the flag  
////////////////////////////////////////////
if($todo=='change_status'){
if($status=='F'){$status='A';}
else{$status='F';}
$sql=$dbo->prepare("update nl_email set status='$status' where email_id=$email_id");
if($sql->execute()){
$todo_return='status_updated';
$db_status='success';
$message='Status Updated';
}else { $message=$sql->errorInfo();}
}// end of if change_status
//////////////////////////////

if($todo=='delete'){
$count=$dbo->prepare("delete from nl_email where email_id=$email_id ");
$count->execute();
$no=$count->rowCount();
if($no ==1){
$todo_return='status_deleted';
$db_status='success';
$message='One record Deleted';
$count=$dbo->prepare("delete from nl_confirm where email_id=$email_id ");
$count->execute();
} // end of if $no ==1
}

$a = array('email_id'=>$email_id,'status'=>$status,'todo_return'=>$todo_return,'db_status'=>$db_status,'message'=>$message);
$a = array('data'=>$a);

echo json_encode($a); 


?>




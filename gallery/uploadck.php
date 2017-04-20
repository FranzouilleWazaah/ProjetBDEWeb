<?Php
require "config.php"; // Database Connection
require "../session.php";



set_time_limit (0);
$max_file_size=2000; // This is in KB

@$gal_id=$_POST['gal_id'];
@$todo=$_POST['todo'];
$userid= $_SESSION['user_session'];  // change this to your userid system. 


/// for thumbnail image size //
$n_width=100;
$n_height=100;
$required_image_width=890; // Width of resized image after uploading
//////////////////



if($todo=='upload'){
if(!($gal_id > 0)){
echo "Select a Gallery  ";
exit;
}


while(list($key,$value) = each($_FILES['userfile']['name']))
{
$dt=date("Y-m-d");

$sql=$dbo->prepare("insert into plus2net_image (gal_id,file_name,userid) values('$gal_id','$value','$userid')");
if($sql->execute()){
$id=$dbo->lastInsertId(); 
$file_name=$id."_".$value;
}
else{//echo mysql_error();
echo "There is a problem in server, not able to add records in database, contact site admin ";
exit;}

$add = $path_upload.$file_name;   // upload directory path is set

copy($_FILES['userfile']['tmp_name'][$key], $add);     //  upload the file to the server

chmod("$add",0777);                 // set permission to the file.

$sql=$dbo->prepare("update plus2net_image set file_name = '$file_name' WHERE img_id=$id");
$sql->execute();

//////////ThumbNail creation //////////////////

if(file_exists($add)){
$tsrc=$path_thumbnail.$file_name; 
$im=ImageCreateFromJPEG($add); 
$width=ImageSx($im); // Original picture width is stored
$height=ImageSy($im); // Original picture height is stored
$newimage=imagecreatetruecolor($n_width,$n_height); 
imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
ImageJpeg($newimage,$tsrc);
chmod("$tsrc",0777);
}// end of if
////////Ending of thumb nail ////////

/////////// Resize if width is more than 890 /////

if($required_image_width < $width){
$adjusted_height=round(($required_image_width/$width) * $height);
//echo $adjusted_height . " - ".$height."<br>";
$im=ImageCreateFromJPEG($add); 
$newimage=imagecreatetruecolor($required_image_width,$adjusted_height); 
imageCopyResized($newimage,$im,0,0,0,0,$required_image_width,$adjusted_height,$width,$height);
ImageJpeg($newimage,$add);
chmod("$add",0777);
} // end of if width of image  is more 

///////////////////////////////////////

echo " &nbsp; <a href=photo.php?img_id=$id target='new'><img src='$tsrc'></a>";
//sleep(5);
} // loop for all files
}// if todo 



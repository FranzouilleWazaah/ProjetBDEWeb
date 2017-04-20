
<?Php
$status_msg='';

if (!in_array("mysql",PDO::getAvailableDrivers(),TRUE))
    {
$status_msg .="<br><font color='red'>PDO sypport is  NOT available </font><br>Read More at http://www.plus2net.com/php_tutorial/pdo-installation.php<br>";
    }else{
$status_msg .="<br><font color='green'>PDO support is available </font><br>";
}

if(!function_exists('mcrypt_create_iv')){
$status_msg .="<br><font color='red'>mcrypt_create_iv function support is NOT available </font><br>";
}else{
$status_msg .="<br><font color='green'>mcrypt_create_iv function support is available </font><br>";
}

if (!extension_loaded('mcrypt')) {
$status_msg .="<br><font color='red'>mcrypt support is NOT loaded</font><br>";
}else{
$status_msg .="<br><font color='green'>mcrypt support is available </font><br>";
}

$status_msg .="<br><br><br>If any support is not avilable, you can read the instructions at <a href=http://www.plus2net.com/php_tutorial/newsletter-admin.php>http://www.plus2net.com/php_tutorial/newsletter-admin.php</a><br><br><br>";

echo $status_msg;
?>


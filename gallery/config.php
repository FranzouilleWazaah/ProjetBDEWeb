<?Php
///////// Database Details , add  here  ////
$dbhost_name = "localhost";
$database = "projetweb";  // Your database name
$username = "root";                  //  Login user id 
$password = "";                  //   Login password
/////////// End of Database Details //////

//// Set the path for upload directory and thumbnail directory////
$path_upload="upload/";
$path_thumbnail="upload_thumb/";
////End of setting path for uploaded images ///

//////// Do not Edit below /////////
try {
$dbo = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}

?> 
<?php
        include_once('db.php');

 		if($_SERVER["REQUEST_METHOD"] == "POST") {

		$username = mysqli_real_escape_string($db,$_POST['username']);
		$password = mysqli_real_escape_string($db,$_POST['password']); 
 
		
		$sql = "SELECT * FROM utilisateur WHERE(
		        username='$username' 
				AND 
				username='$password')" or die ("failed to query database".mysql_error());
 
 
	    $res = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($res,MYSQLI_ASSOC);
  		

		if ($row['username'] == $username && $row['password'] == $password) {
			echo "Login success ! Welcome ".$row['username']; 
		} else {
			echo "Failed to login, try again !";
		}
		
 }
?>
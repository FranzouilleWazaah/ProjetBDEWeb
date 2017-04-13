<?php

// est appelé par l'index lorsque l'utilisateur fait l'action de rentrer ses identifiants
// cela compare les identifiants que l'utilisateur a écrit et ceux en base de donnée

        include_once('db.php');
        include_once('fonctions/Alert.php');
     //   include_once('fonctions/encryption.php');

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
			
			Alert("Login success ! Welcome on the BDE of CESI Lyon !");
			// header('Location: home.php');
		} else {
			
		Alert("Failed to login, try again please.");
		// header('Location: login.php');
 }
}
?>
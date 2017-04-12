<?php
      include_once('db.php');
 
 // On utilise mysql real escape pour éviter l'injection de SQL par l'utilisateur 

	  $username = mysqli_real_escape_string($db,$_POST["username"] );
	  $password = mysqli_real_escape_string($db,$_POST["password"]) );
	  $fname = mysqli_real_escape_string($db,$_POST["prenom"] );
	  $lname = mysqli_real_escape_string($db,$_POST["nom"] );
 
	  $sql = "INSERT INTO utilisateur VALUES('',
                                           '$username', 
                                           '$password', 
                                           '$fname', 
                                           '$lname')";
	  if( mysql_query($sql) )
	   echo "Inserted Successfully";
	  else
	   echo "Insertion Failed";
?>
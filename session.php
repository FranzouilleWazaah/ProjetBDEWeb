<?php

	session_start();
	
	require_once 'class/user.php';
	$session = new USER();
	
	// if user session is not active(not loggedin) this page will help 'home.php and profile.php' to redirect to login page
	// put this file within secured pages that users (users can't access without login)
	
	if(!$session->is_loggedin())
	{
		// session no set redirects to login page
<<<<<<< HEAD
		$session->redirect("login.php");
=======
<<<<<<< HEAD
		$session->redirect("C:/xampp/htdocs/website/ProjetBDEWeb/home.php");
=======
		$session->redirect("C:/Wamp64/www/ProjetBDEWeb/login.php");
>>>>>>> origin/master
>>>>>>> origin/master
	}
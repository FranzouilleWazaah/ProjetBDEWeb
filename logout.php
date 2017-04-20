<?php
<<<<<<< HEAD
	require_once("session.php");
	require_once("class/user.php");
=======
	require_once("C:/xampp/htdocs/website/ProjetBDEWeb/session.php");
	require_once("C:/xampp/htdocs/website/ProjetBDEWeb/class/user.php");
>>>>>>> origin/master
	$user_logout = new USER();
	
	session_destroy();
    unset($_SESSION['user_session']);
    header("Location: login.php");
	// $user_logout->redirect('C:/Wamp64/www/ProjetBDEWeb/login.php');
	exit;
	

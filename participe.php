<?php
require_once ("class/user.php");
require_once("session.php");
require_once("fonctions/Alert.php");

$user = new USER();
$id_perso = $_SESSION['user_session'];

try{
$stmt = $user->runQuery('SELECT postTitle, eve_date FROM blog_posts WHERE postID = :postID');
            $stmt->execute(array(':postID' => $_GET['id']));
            $row = $stmt->fetch(); 
}
catch(PDOException $e) {
			    echo $e->getMessage();
			}
$eve_nom = $row['postTitle'];
$evedate = $row['eve_date'];
try{
$stmt = $user->runQuery('SELECT eve_nom, eve_date, eve_participant FROM evenement WHERE eve_nom = :eve_nom AND eve_date = :eve_date AND eve_participant = :eve_participant');
            $stmt->execute(array(
            	'eve_nom' => $eve_nom,
            	'eve_date' => $evedate,
            	'eve_participant' => $id_perso
            	));
             
}
catch(PDOException $e) {
			    echo $e->getMessage();
			}
if ($stmt->Rowcount() > 0) {
	header("Location: home.php?error=1");
	alert("Error, contact a bde member please");
	exit();
}
else{

	try{
	$stmt1 = $user->runQuery('INSERT INTO evenement (eve_nom,eve_date,eve_participant) VALUES (:nom, :evedate, :participant)') ;
	$stmt1->execute(array(
						'nom' => $eve_nom,
						'evedate' => $evedate,
						'participant' => $id_perso,
					));

	}

	catch(PDOException $e) {
				    echo $e->getMessage();
				}
			alert("You are registered on this activity");
			header("refresh:1;url=home.php?error=0");

			exit();
}
?>
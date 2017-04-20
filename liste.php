<?php //include config
require_once ("class/user.php");
require_once("session.php");

$user = new USER();
if(!$user->is_loggedin()){ header('Location: login.php'); }
?>

<!doctype html>
<html lang="en">
<header>
<meta charset="utf-8">
  <title>Admin</title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
</header>
<body>
<div id="wrapper">

	
	<p><a href="index-admin.php">Blog Admin Index</a></p>

	<h2>Liste participants</h2>


	<?php
	//if form has been submitted process it
	try
	{
	$stmt = $user->runQuery('SELECT eve_participant FROM evenement WHERE eve_nom = :eve_nom');
	$stmt->execute(array(
						'eve_nom' =>$_GET['name']
					));

	}
	catch(PDOException $e) 
	{
				    echo $e->getMessage();
	}
	echo '<h3> Activité : '.$_GET['name'].' </h3>';

	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		extract($row);
		$stmt1 = $user->runQuery('SELECT nom, prenom, email FROM utilisateur WHERE id = :participant');
		$stmt1->execute(array(
						'participant' =>$row['eve_participant']
					));
		$row1 = $stmt1->fetch();
			echo '<div>';
                        echo '<p> '.$row1['nom'].' '.$row1['prenom'].' | '.$row1['email'].' </p>';            
                    echo '</div>';
	}
	?>
	</div>
	</body>
	


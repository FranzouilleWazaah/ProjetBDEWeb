<?php 
include("class/panier.class.php");
require_once ("class/user.php");
require_once 'database.php';
require_once("session.php");

$db = new Database();
$panier = new Panier($db);

$auth_user = new USER();
  
  
  $id = $_SESSION['user_session'];

  $stmt = $auth_user->runQuery("SELECT * FROM utilisateur WHERE id=:id");
  $stmt->execute(array(":id"=>$id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<meta name="description" content="web design responsive">
	<title>BDE CESI - Lyon / Boutique</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script type="text/javascript" src="js/DynamicForm.js"></script>
</head>

<body>
	<header>
		<div id="branding">
			<img src="img/logo_bde.png" width="250px" height="250px">
		</div>
		 <?php 
    include 'avatar.php';
      ?>
    <nav>
     <ul>
				<li class="current"><a href="home.php">Home</a></li>
				<li><a href="gallery/gallery.php">Photos</a></li>
				<li><a href="boutique.php">Shop</a></li>
				<li><a href="contact.php">Contact us</a></li>
				<?php // Displays the tab if the user has the correct permission

				if ($_SESSION['permissions']=='cesiMember')
				{
					echo '<li><a href="gallery/admin/index.php">Manage photos</a></li>';
				}

				?>

				<?php // Displays the tab if the user has the correct permission

				if ($_SESSION['permissions']=='bdeMember')
				{
					echo '<li><a href="index-admin.php">Add article</a></li>';
				}

				?>

			</ul>
	</header>

	<div class="container" id="boutiqueDescription">
		<h1>Votre panier</h1>
	</div>

	<section id="sectionBoutique">
		<div class="container">
		<form action="panier.php" method="post">

			<table class="tabBoutique">
						<tr>
							<th>Objet</th>
							<th>Prix</th>
							<th>Photo</th>
							<th>Quantité</th>
							<th>Supprimer</th>
						</tr>
				<?php
					$ids = array_keys($_SESSION['panier']);
					if(empty($ids)){
						$products = array();
					}else{
					$products = $db->query('SELECT * FROM boutique WHERE id IN ('.implode(',',$ids).')');
					}
					foreach($products as $product)
					{
					?>
						<tr>
							<td><?= $product->objet; ?></td>
							<td><?= number_format($product->prix, 2,',','');?> €</td>
							<td><img src="<?= $product->photo; ?>" width="100px" height="100px"></td>
							<td><?= $_SESSION['panier'][$product->id]; ?></td>
							<td><a href="panier.php?delPanier=<?= $product->id; ?>">Delete</a></td>
						</tr>
					<?php
					}
				?>
			</table>

			<div class="total">
				<h2>Total price : <?= number_format($panier->total(),2,',',' '); ?> €</h2>
				<h2>Total product : <?= $panier->count(); ?> </h2>
			</div>
			<a class="cart" href="boutique.php">Revenir à la boutique</a>
		</form>	
		</div>
	</section>

	<footer>
		<div class="container">
			<p>BDE CESI - Lyon, Copyright &copy; 2017</p>
		</div>
	</footer>
</body>
</html>

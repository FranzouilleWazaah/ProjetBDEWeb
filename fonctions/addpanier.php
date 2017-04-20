<?php 
include("../class/panier.class.php");
require_once 'C:/xampp/htdocs/website/ProjetBDEWeb4/database.php';
$db = new Database();
$panier = new Panier($db);

if(isset($_GET['id'])){
	$product = $db->query("SELECT id FROM boutique WHERE id=:id", array('id' => $_GET['id']));
	if(empty($product))
	{
		die("Ce produit n'existe pas");
	}
	$panier->add($product[0]->id);
	die('Le produit a bien été ajouté à votre panier <a href="#" onClick="javascript:history.back()">Go back to shopping</a>');
}else{
	die("Vous n'avez pas sélectionné de produit à ajouter au panier");
}
?>